<?php

namespace App\Lib\Report;

use App\Models\Game\GameProject;
use App\Models\Report\ReportDayGameVendor;
use App\Models\Report\ReportDayPlatformGame;
use App\Models\Report\ReportDayPlatformGameVendor;
use App\Models\Report\ReportDayUser;
use App\Models\Report\ReportDayUserGameVendor;

/**
 * 游戏报表相关
 */
class GameReport
{
    /**
     * @param  GameProject $gameProject 游戏注单.
     * @return boolean
     */
    public static function saveReport(GameProject $gameProject): bool
    {
        if ($gameProject->is_counted_report !== GameProject::COUNTED_REPORT_NO) {
            return true;
        }
        //用户日报表
        $saveUserReport = ReportDayUser::saveGameReport($gameProject);
        if ($saveUserReport !== true) {
            return false;
        }
        //用户游戏厂商统计日报表
        $saveUserVendorReport = ReportDayUserGameVendor::saveGameReport($gameProject);
        if ($saveUserVendorReport !== true) {
            return false;
        }
        //代理平台游戏报表
        $savePlatformGameReport = ReportDayPlatformGame::saveGameReport($gameProject);
        if ($savePlatformGameReport !== true) {
            return false;
        }
        //代理平台游戏厂商报表
        $savePlatformVendorReport = ReportDayPlatformGameVendor::saveGameReport($gameProject);
        if ($savePlatformVendorReport !== true) {
            return false;
        }
        //游戏厂商日总报表
        return ReportDayGameVendor::saveGameReport($gameProject);
    }
}
