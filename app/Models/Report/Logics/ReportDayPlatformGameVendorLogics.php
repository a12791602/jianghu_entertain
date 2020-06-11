<?php

namespace App\Models\Report\Logics;

use Carbon\CarbonInterface;

/**
 * trait ReportDayPlatformGameVendorLogics
 * @package App\Models\User\Logics
 */
trait ReportDayPlatformGameVendorLogics
{
    /**
     * @param  string          $platformSign   平台标识.
     * @param  CarbonInterface $createAt       日期.
     * @param  string          $gameVendorSign 游戏平台标识.
     * @param  string          $vendorName     游戏平台名称.
     * @param  float           $betSum         下注金额.
     * @param  float           $effectiveBet   有效下注金额.
     * @param  float           $winSum         中奖金额.
     * @param  float           $taxSum         税收金额.
     * @param  float           $commissionSum  返利.
     * @return boolean
     */
    public static function saveData(
        string $platformSign,
        CarbonInterface $createAt,
        string $gameVendorSign,
        string $vendorName,
        float $betSum,
        float $effectiveBet,
        float $winSum,
        float $taxSum,
        float $commissionSum
    ): bool {
        $vendorReportFilter = [
                               'platform_sign'    => $platformSign,
                               'game_vendor_sign' => $gameVendorSign,
                               'project_day'      => [$createAt],
                              ];
        $vendorReport       = self::filter($vendorReportFilter)->first();
        if ($vendorReport === null) {
            $vendorReport     = new self();
            $vendorReportData = [
                                 'platform_sign'    => $platformSign,
                                 'game_vendor_sign' => $gameVendorSign,
                                 'game_vendor_name' => $vendorName,
                                 'bet_money'        => $betSum,
                                 'effective_bet'    => $effectiveBet,
                                 'win_money'        => $winSum,
                                 'our_net_win'      => $taxSum,
                                 'commission'       => $commissionSum,
                                 'day'              => $createAt,
                                ];
            $vendorReport->fill($vendorReportData);
        } else {
            $vendorReport->bet_money   += $betSum;
            $vendorReport->win_money   += $winSum;
            $vendorReport->our_net_win += $taxSum;
            $vendorReport->commission  += $commissionSum;
        }
        return $vendorReport->save();
    }
}
