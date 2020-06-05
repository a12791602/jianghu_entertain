<?php

namespace App\Lib\Report;

use App\Models\Game\GameProject;
use App\Models\Report\ReportDayGameVendor;
use App\Models\User\UsersReportDay;

/**
 * 游戏报表相关
 */
class GameReport
{
    /**
     * @param  GameProject $gameProject 游戏注单.
     * @return void
     */
    public static function saveReport(GameProject $gameProject): void
    {
        if ($gameProject->is_counted_report !== GameProject::COUNTED_REPORT_NO) {
            return;
        }
        //用户日报表
        UsersReportDay::saveGameReport($gameProject);
        //游戏厂商日总报表
        ReportDayGameVendor::saveGameReport($gameProject);
    }
}
