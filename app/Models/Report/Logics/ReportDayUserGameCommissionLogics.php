<?php

namespace App\Models\Report\Logics;

use App\Models\User\FrontendUser;
use Carbon\CarbonInterface;

trait ReportDayUserGameCommissionLogics
{
    /**
     * 保存和更新日报表
     * @param  FrontendUser    $user           用户.
     * @param  string          $gameVendorSign 游戏厂商标识.
     * @param  string          $gameSign       游戏标识.
     * @param  float           $betMoney       下注金额.
     * @param  float           $effectiveBet   有效下注金额.
     * @param  float           $rebate         洗码金额.
     * @param  CarbonInterface $reportDay      报表日期.
     * @return boolean
     */
    public static function saveReport(
        FrontendUser $user,
        string $gameVendorSign,
        string $gameSign,
        float $betMoney,
        float $effectiveBet,
        float $rebate,
        CarbonInterface $reportDay
    ): bool {
        $filterArr        = [
                             'platform_sign' => $user->platform_sign,
                             'guid'          => $user->guid,
                             'game_sign'     => $gameSign,
                             'report_day'    => [$reportDay],
                            ];
        $commissionReport = self::filter($filterArr)->first();
        if ($commissionReport === null) {
            $commissionReport = new self();
            $addData          = [
                                 'platform_sign'    => $user->platform_sign,
                                 'mobile'           => $user->mobile,
                                 'guid'             => $user->guid,
                                 'game_vendor_sign' => $gameVendorSign,
                                 'game_sign'        => $gameSign,
                                 'bet'              => $betMoney,
                                 'effective_bet'    => $effectiveBet,
                                 'rebate'           => $rebate,
                                 'day'              => $reportDay,
                                ];
            $commissionReport->fill($addData);
        } else {
            $commissionReport->bet           += $betMoney;
            $commissionReport->effective_bet += $effectiveBet;
            $commissionReport->rebate        += $rebate;
        }//end if
        return $commissionReport->save();
    }
}
