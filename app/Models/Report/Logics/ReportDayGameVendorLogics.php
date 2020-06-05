<?php

namespace App\Models\Report\Logics;

use App\Models\Game\GameProject;
use Carbon\CarbonInterface;

trait ReportDayGameVendorLogics
{
    /**
     * 游戏报表
     * @param  GameProject $gameProject 游戏注单.
     * @return boolean
     */
    public static function saveGameReport(GameProject $gameProject): bool
    {
        $reportDay    = $gameProject->created_at->format('Y-m-d');
        $vendorSign   = $gameProject->game_vendor_sign;
        $filterArr    = [
                         'game_vendor_sign' => $vendorSign,
                         'report_day'       => [$reportDay],
                        ];
        $reportEloq   = self::filter($filterArr)->first();
        $effectiveBet = $gameProject->bet_money - $gameProject->win_money;
        $effectiveBet = $effectiveBet < 0 ? 0 : $effectiveBet;
        if ($reportEloq === null) {
            $reportEloq = new self();
            $addData    = [
                           'game_vendor_sign' => $vendorSign,
                           'bet'              => $gameProject->bet_money,
                           'win_money'        => $gameProject->win_money,
                           'tax'              => $gameProject->our_net_win,
                           'effective_bet'    => $effectiveBet,
                           'day'              => $reportDay,
                          ];
            $reportEloq->fill($addData);
        } else {
            $reportEloq->bet           += $gameProject->bet_money;
            $reportEloq->win_money     += $gameProject->win_money;
            $reportEloq->tax           += $gameProject->our_net_win;
            $reportEloq->effective_bet += $effectiveBet;
        }//end if
        return $reportEloq->save();
    }

    /**
     * 返利报表
     * @param  string          $vendorSign 游戏厂商标识.
     * @param  CarbonInterface $reportDay  日期.
     * @param  float           $rebate     洗码返利.
     * @return boolean
     */
    public static function saveRebateReport(
        string $vendorSign,
        CarbonInterface $reportDay,
        float $rebate
    ): bool {
        $filterArr  = [
                       'game_vendor_sign' => $vendorSign,
                       'report_day'       => [$reportDay],
                      ];
        $reportEloq = self::filter($filterArr)->first();
        if ($reportEloq === null) {
            $reportEloq = new self();
            $addData    = [
                           'game_vendor_sign' => $vendorSign,
                           'rebate'           => $rebate,
                           'day'              => $reportDay,
                          ];
            $reportEloq->fill($addData);
        } else {
            $reportEloq->rebate += $rebate;
        }//end if
        return $reportEloq->save();
    }

    /**
     * 佣金报表
     * @param  string          $vendorSign 游戏厂商标识.
     * @param  CarbonInterface $reportDay  日期.
     * @param  float           $commission 佣金.
     * @return boolean
     */
    public static function saveCommissionReport(
        string $vendorSign,
        CarbonInterface $reportDay,
        float $commission
    ): bool {
        $filterArr  = [
                       'game_vendor_sign' => $vendorSign,
                       'report_day'       => [$reportDay],
                      ];
        $reportEloq = self::filter($filterArr)->first();
        if ($reportEloq === null) {
            $reportEloq = new self();
            $addData    = [
                           'game_vendor_sign' => $vendorSign,
                           'commission'       => $commission,
                           'day'              => $reportDay,
                          ];
            $reportEloq->fill($addData);
        } else {
            $reportEloq->commission += $commission;
        }//end if
        return $reportEloq->save();
    }
}
