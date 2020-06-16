<?php

namespace App\Console\Commands;

use App\Models\Game\GameProject;
use App\Models\Report\ReportDayGameVendor;
use App\Models\Report\ReportDayUser;
use App\Models\Report\ReportDayUserCommission;
use App\Models\Report\ReportDayUserGameCommission;
use App\Models\User\FrontendUser;
use App\Models\User\UsersCommissionConfig;
use Carbon\Carbon;
use Carbon\CarbonInterface;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

/**
 * 统计前一天的游戏洗码返佣
 */
class StatisticalCommission extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'statisticalCommission';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '统计前一天的游戏洗码返佣';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle(): void
    {
        $reportDay        = Carbon::yesterday();
        $filterArr        = [
                             'created_at'        => [$reportDay],
                             'commission_status' => GameProject::COMMISSION_STATUS_NO,
                             'status_in'         => [
                                                     GameProject::STATUS_LOSE,
                                                     GameProject::STATUS_WIN,
                                                     GameProject::STATUS_WIN_CALCULATE,
                                                    ],
                            ];//昨天已经结算成功并且未计算洗码的注单
        $userGroupProject = GameProject::filter($filterArr)->get()->groupBy('user_id');
        foreach ($userGroupProject as $itemUserProjects) {
            $user = $itemUserProjects->first()->user;
            if ($user === null) {
                continue;
            }
            $vendorGroupProject = $itemUserProjects->groupBy('game_vendor_sign');
            DB::beginTransaction();
            //游戏相关报表
            $userRebate = $this->_saveGameReport($vendorGroupProject, $user, $reportDay);
            //佣金返利报表
            $saveReportCommisstion = $this->_saveReportCommisstion($user, $reportDay, $userRebate, $vendorGroupProject);
            if ($saveReportCommisstion !== true) {
                DB::rollback();
                continue;
            }
            DB::commit();
        }
    }

    /**
     * @param  Collection      $vendorGroupProject 注单.
     * @param  FrontendUser    $user               用户.
     * @param  CarbonInterface $reportDay          日期.
     * @return float
     */
    private function _saveGameReport(
        Collection $vendorGroupProject,
        FrontendUser $user,
        CarbonInterface $reportDay
    ): float {
        $userRebate = 0; //用户个人报表的洗码奖金总额
        foreach ($vendorGroupProject as $vendorSign => $itemVendorProject) {
            $vendorSign         = (string) $vendorSign; //钩子认定foreach的key是int类型，所以做下转换
            $vendorBetSum       = 0;
            $vendorEffectiveBet = 0;
            $vendorRebateSum    = 0;
            $projectId          = [];
            foreach ($itemVendorProject->groupBy('game_sign') as $gameSign => $itemGameProject) {
                $gameEffectiveBet = $this->_getGameEffectiveBet($itemGameProject);
                $gamebetSum       = $itemGameProject->sum('bet_money');
                $rebatePercent    = UsersCommissionConfig::getCommissionPercent($user, $vendorSign, $gamebetSum);
                $gameRebateSum    = $gameEffectiveBet * $rebatePercent / 100;
                $saveGameRebate   = ReportDayUserGameCommission::saveReport(
                    $user,
                    $vendorSign,
                    $gameSign,
                    $gamebetSum,
                    $gameEffectiveBet,
                    $gameRebateSum,
                    $reportDay,
                );
                if ($saveGameRebate === false) {
                    DB::rollback();
                    continue;
                }
                $projectId           = Arr::collapse([$projectId, $itemGameProject->pluck('id')->toArray()]);
                $vendorBetSum       += $gamebetSum;
                $vendorEffectiveBet += $gameEffectiveBet;
                $vendorRebateSum    += $gameRebateSum;
                $userRebate         += $gameRebateSum;
            }//end foreach
            $saveUserRebate   = ReportDayUserCommission::saveReport(
                $user,
                $vendorSign,
                $vendorBetSum,
                $vendorEffectiveBet,
                $vendorRebateSum,
                $reportDay,
            );
            $saveVendorRebate = ReportDayGameVendor::saveRebateReport($vendorSign, $reportDay, $vendorRebateSum);
            if ($saveUserRebate === false || $saveVendorRebate === false) {
                DB::rollback();
                continue;
            }
            GameProject::whereIn('id', $projectId)->update(['commission_status' => GameProject::COMMISSION_STATUS_YES]);
        }//end foreach
        return $userRebate;
    }

    /**
     * 获取有效下注
     * @param  Collection $itemGameProject 游戏注单.
     * @return float
     */
    private function _getGameEffectiveBet(Collection $itemGameProject): float
    {
        $compliantProject = $itemGameProject->filter(
            static function ($project) {
                return $project->win_money < $project->bet_money;
            },
        );//有效下注需要筛选出下注金额大于中奖金额的注单
        return $compliantProject->sum('bet_money') - $compliantProject->sum('win_money');
    }

    /**
     * 保存用户日报表
     * @param  FrontendUser    $user               用户.
     * @param  CarbonInterface $reportDay          日期.
     * @param  float           $userRebate         洗码返利.
     * @param  Collection      $vendorGroupProject 游戏注单.
     * @return boolean
     */
    private function _saveReportCommisstion(
        FrontendUser $user,
        CarbonInterface $reportDay,
        float $userRebate,
        Collection $vendorGroupProject
    ): bool {
        $saveRebate = ReportDayUser::saveRebateReport($user, $reportDay, $userRebate);
        if ($saveRebate === false) {
            return false;
        }
        foreach ($vendorGroupProject as $gameVendorSign => $gameProjects) {
            $saveCommission = $this->_saveCommission($user, $reportDay, (string) $gameVendorSign, $gameProjects);
            if ($saveCommission === false) {
                return false;
            }
        }
        return true;
    }

    /**
     * 保存佣金报表
     * @param  FrontendUser    $user           用户.
     * @param  CarbonInterface $reportDay      日期.
     * @param  string          $gameVendorSign 游戏厂商标识.
     * @param  Collection      $gameProjects   游戏注单.
     * @return boolean
     */
    private function _saveCommission(
        FrontendUser $user,
        CarbonInterface $reportDay,
        string $gameVendorSign,
        Collection $gameProjects
    ): bool {
        $vendorCommissionSum = 0;
        $userWinLose         = $gameProjects->sum('win_money') - $gameProjects->sum('bet_money');
        //玩家不输钱的时候不需要给上级发放佣金
        if ($userWinLose >= 0) {
            return true;
        }
        $userRid = $user->rid;
        if (is_array($userRid)) {
            //倒叙数组，从最近的上级开始发放佣金
            $userRid      = array_reverse($userRid);
            $platformSign = $user->platform_sign;
            foreach ($userRid as $ridKey => $userId) {
                $level = (int) $ridKey + 1;//当前层级，key从0开始计算，所以+1
                //当到达第四层代理（系统只发放3级返佣）或没有代理时，佣金发放结束。
                if ($ridKey === 3 || $userId === 0) {
                    break;
                }
                //上级用户
                $agent = FrontendUser::find($userId);
                if (!$agent instanceof FrontendUser) {
                    break;
                }
                //获取当前层级返佣百分比
                $configSign           = 'rebate_percentage_' . $level; //当前返佣层级标识
                $commissionPercentage = configure($platformSign, $configSign);
                if ($commissionPercentage === null) {
                    break;
                }
                //保存用户佣金
                $commission     = abs($userWinLose) * $commissionPercentage / 100;
                $saveCommission = ReportDayUser::saveCommissionReport($agent, $reportDay, $commission);
                if ($saveCommission !== true) {
                    return false;
                }
                $vendorCommissionSum += $commission;
            }//end foreach
        }//end if
        return ReportDayGameVendor::saveCommissionReport($gameVendorSign, $reportDay, $vendorCommissionSum);
    }
}
