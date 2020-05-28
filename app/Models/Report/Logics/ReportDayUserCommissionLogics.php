<?php

namespace App\Models\Report\Logics;

use App\Models\User\FrontendUser;
use Carbon\CarbonInterface;

trait ReportDayUserCommissionLogics
{
    /**
     * 保存和更新用户日总报表
     * @param  FrontendUser    $user           用户.
     * @param  string          $gameVendorSign 游戏厂商标识.
     * @param  float           $betMoney       下注金额.
     * @param  float           $effectiveBet   有效下注金额.
     * @param  float           $commission     洗码金额.
     * @param  CarbonInterface $reportDay      报表日期.
     * @return boolean
     */
    public static function saveReport(
        FrontendUser $user,
        string $gameVendorSign,
        float $betMoney,
        float $effectiveBet,
        float $commission,
        CarbonInterface $reportDay
    ): bool {
        $filterArr        = [
                             'platform_sign'    => $user->platform_sign,
                             'game_vendor_sign' => $gameVendorSign,
                             'guid'             => $user->guid,
                             'report_day'       => [$reportDay],
                            ];
        $commissionReport = self::filter($filterArr)->first();
        if ($commissionReport === null) {
            $commissionReport = new self();
            $addData          = [
                                 'platform_sign'    => $user->platform_sign,
                                 'mobile'           => $user->mobile,
                                 'guid'             => $user->guid,
                                 'game_vendor_sign' => $gameVendorSign,
                                 'bet'              => $betMoney,
                                 'effective_bet'    => $effectiveBet,
                                 'commission'       => $commission,
                                 'day'              => $reportDay,
                                ];
            $commissionReport->fill($addData);
        } else {
            $commissionReport->bet           += $betMoney;
            $commissionReport->effective_bet += $effectiveBet;
            $commissionReport->commission    += $commission;
        }//end if
        return $commissionReport->save();
    }
}
