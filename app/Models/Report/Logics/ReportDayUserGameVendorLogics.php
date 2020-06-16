<?php

namespace App\Models\Report\Logics;

use App\Models\Game\GameProject;
use App\Models\User\FrontendUser;
use Carbon\CarbonInterface;

/**
 * trait ReportDayUserGameVendorLogics
 * @package App\Models\User\Logics
 */
trait ReportDayUserGameVendorLogics
{
    /**
     * @param  GameProject $gameProject 游戏注单.
     * @return boolean
     */
    public static function saveGameReport(GameProject $gameProject): bool
    {
        $filterArr    = [
                         'user_id'          => $gameProject->user_id,
                         'game_vendor_sign' => $gameProject->game_vendor_sign,
                         'report_day'       => [$gameProject->created_at],
                        ];
        $reportEloq   = self::filter($filterArr)->first();
        $effectiveBet = $gameProject['bet_money'] - $gameProject['win_money'];
        $effectiveBet = $effectiveBet < 0 ? 0 : $effectiveBet;
        if ($reportEloq === null) {
            $reportEloq = new self();
            $addData    = [
                           'platform_sign'    => $gameProject->platform_sign,
                           'user_id'          => $gameProject->user_id,
                           'game_vendor_sign' => $gameProject->game_vendor_sign,
                           'game_vendor_name' => $gameProject->gameVendor->name ?? '',
                           'bet_money'        => $gameProject->bet_money,
                           'effective_bet'    => $effectiveBet,
                           'win_money'        => $gameProject->win_money,
                           'day'              => $gameProject->created_at,
                          ];
            $reportEloq->fill($addData);
        } else {
            $reportEloq->bet_money     += $gameProject->bet_money;
            $reportEloq->effective_bet += $effectiveBet;
            $reportEloq->win_money     += $gameProject->win_money;
        }
        return $reportEloq->save();
    }

    /**
     * @param  FrontendUser    $user           用户.
     * @param  string          $gameVendorSign 游戏厂商标识.
     * @param  CarbonInterface $reportDay      日期.
     * @param  float           $rebate         洗码金额.
     * @param  float           $rebatePercent  洗码比例.
     * @return boolean
     */
    public static function saveRebate(
        FrontendUser $user,
        string $gameVendorSign,
        CarbonInterface $reportDay,
        float $rebate,
        float $rebatePercent
    ): bool {
        $filterArr  = [
                       'user_id'          => $user->user_id,
                       'game_vendor_sign' => $gameVendorSign,
                       'report_day'       => [$reportDay],
                      ];
        $reportEloq = self::filter($filterArr)->first();
        if ($reportEloq === null) {
            return false;
        }
        $reportEloq->rebate  = $rebate;
        $reportEloq->percent = $rebatePercent;
        return $reportEloq->save();
    }
}
