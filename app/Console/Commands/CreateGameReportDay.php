<?php

namespace App\Console\Commands;

use App\Models\Game\GameProject;
use App\Models\Report\ReportDayPlatformGame;
use App\Models\Report\ReportDayPlatformGameVendor;
use App\Models\Systems\SystemPlatform;
use Carbon\Carbon;
use Carbon\CarbonInterface;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

/**
 * 生成前一天的游戏日报表
 */
class CreateGameReportDay extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'createGameReportDay';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '生成前一天的游戏日报表';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle(): void
    {
        $createAt = Carbon::yesterday();
        $platform = SystemPlatform::pluck('sign')->toArray();
        foreach ($platform as $platformSign) {
            $gameProject      = GameProject::whereDate('created_at', $createAt)
                ->filter(
                    [
                     'platform_sign' => $platformSign,
                     'status_in'     => [
                                         GameProject::STATUS_LOSE,
                                         GameProject::STATUS_WIN,
                                         GameProject::STATUS_WIN_CALCULATE,
                                        ],
                    ],
                )
                ->get();
            $gameProjectGroup = $gameProject->groupBy('game_sign');
            $this->_saveData($gameProjectGroup, $createAt);
        }
    }

    /**
     * @param  Collection      $gameProjectGroup 游戏注单.
     * @param  CarbonInterface $createAt         日期.
     * @return void
     */
    private function _saveData(
        Collection $gameProjectGroup,
        CarbonInterface $createAt
    ): void {
        foreach ($gameProjectGroup as $gameSign => $projectGroup) {
            $compliantProject = $projectGroup->filter(
                static function ($project) {
                    return $project->win_money < $project->bet_money;
                },
            );
            $effectiveBet     = $compliantProject->sum('bet_money') - $compliantProject->sum('win_money');
            $betSum           = $projectGroup->sum('bet_money');
            $winSum           = $projectGroup->sum('win_money');
            $taxSum           = $projectGroup->sum('our_net_win'); //税收暂时用我们平台赢的金额，后续可能会有改动
            $commissionSum    = $projectGroup->sum('commission');
            $projectItem      = $projectGroup->first();
            $addData          = [
                                 'platform_sign'    => $projectItem->platform_sign,
                                 'game_sign'        => $gameSign,
                                 'game_name'        => $projectItem->game->name ?? '',
                                 'game_vendor_sign' => $projectItem->game_vendor_sign,
                                 'bet_money'        => $betSum,
                                 'effective_bet'    => $effectiveBet,
                                 'win_money'        => $winSum,
                                 'our_net_win'      => $taxSum,
                                 'commission'       => $commissionSum,
                                 'day'              => $createAt,
                                ];
            $reportDayGame    = new ReportDayPlatformGame();
            $reportDayGame->fill($addData);
            DB::beginTransaction();
            if ($reportDayGame->save() === false) {
                saveLog('game', '生成游戏日报表失败，平台：' . $projectItem->platform_sign . '|' . $createAt->format('Y-m-d'));
                continue;
            }
            $saveVendorReport = ReportDayPlatformGameVendor::saveData(
                $projectItem->platform_sign,
                $createAt,
                $projectItem->game_vendor_sign,
                $projectItem->gameVendor->name ?? '',
                $betSum,
                $effectiveBet,
                $winSum,
                $taxSum,
                $commissionSum,
            );
            if ($saveVendorReport === false) {
                DB::rollback();
                saveLog('game', '修改游戏平台日报表失败，平台：' . $projectItem->platform_sign . '|' . $createAt->format('Y-m-d'));
                continue;
            }
            DB::commit();
        }//end foreach
    }
}
