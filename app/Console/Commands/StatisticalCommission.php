<?php

namespace App\Console\Commands;

use App\Models\Game\GameProject;
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
 * 统计前一天的游戏洗码
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
    protected $description = '统计前一天的游戏洗码';

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
            $this->_saveCommissionReport($vendorGroupProject, $user, $reportDay);
        }
    }

    /**
     * @param  Collection      $vendorGroupProject 注单.
     * @param  FrontendUser    $user               用户.
     * @param  CarbonInterface $reportDay          日期.
     * @return void
     */
    private function _saveCommissionReport(
        Collection $vendorGroupProject,
        FrontendUser $user,
        CarbonInterface $reportDay
    ): void {
        foreach ($vendorGroupProject as $vendorSign => $itemVendorProject) {
            $vendorSign          = (string) $vendorSign; //钩子认定foreach的key是int类型，所以做下转换
            $vendorBetSum        = 0;
            $vendorEffectiveBet  = 0;
            $vendorCommissionSum = 0;
            $projectId           = [];
            DB::beginTransaction();
            foreach ($itemVendorProject->groupBy('game_sign') as $gameSign => $itemGameProject) {
                $gameEffectiveBet   = $this->_getGameEffectiveBet($itemGameProject);
                $gamebetSum         = $itemGameProject->sum('bet_money');
                $commissionPercent  = UsersCommissionConfig::getCommissionPercent($user, $vendorSign, $gamebetSum);
                $gameCommissionSum  = $gameEffectiveBet * $commissionPercent / 100;
                $saveGameCommission = ReportDayUserGameCommission::saveReport(
                    $user,
                    $vendorSign,
                    $gameSign,
                    $gamebetSum,
                    $gameEffectiveBet,
                    $gameCommissionSum,
                    $reportDay,
                );
                if ($saveGameCommission === false) {
                    DB::rollback();
                    continue;
                }
                $projectId            = Arr::collapse([$projectId, $itemGameProject->pluck('id')->toArray()]);
                $vendorBetSum        += $gamebetSum;
                $vendorEffectiveBet  += $gameEffectiveBet;
                $vendorCommissionSum += $gameCommissionSum;
            }//end foreach
            $saveVendorCommission = ReportDayUserCommission::saveReport(
                $user,
                $vendorSign,
                $vendorBetSum,
                $vendorEffectiveBet,
                $vendorCommissionSum,
                $reportDay,
            );
            if ($saveVendorCommission === false) {
                DB::rollback();
                continue;
            }
            GameProject::whereIn('id', $projectId)->update(['commission_status' => GameProject::COMMISSION_STATUS_YES]);
            DB::commit();
        }//end foreach
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
}
