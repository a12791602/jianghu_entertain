<?php

namespace App\Models\Report\Logics;

use App\Models\Game\GameProject;

/**
 * trait ReportDayPlatformGameLogics
 * @package App\Models\User\Logics
 */
trait ReportDayPlatformGameLogics
{
    /**
     * @param  GameProject $gameProject 游戏注单.
     * @return boolean
     */
    public static function saveGameReport(GameProject $gameProject): bool
    {
        $filterArr    = [
                         'platform_sign'    => $gameProject->platform_sign,
                         'game_sign'        => $gameProject->game_sign,
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
                           'game_sign'        => $gameProject->game_sign,
                           'game_name'        => $gameProject->game->name ?? '',
                           'game_vendor_sign' => $gameProject->game_vendor_sign,
                           'bet_money'        => $gameProject->bet_money,
                           'effective_bet'    => $effectiveBet,
                           'win_money'        => $gameProject->win_money,
                           'our_net_win'      => $gameProject->our_net_win,
                           'day'              => $gameProject->created_at,
                          ];
            $reportEloq->fill($addData);
        } else {
            $reportEloq->bet_money     += $gameProject->bet_money;
            $reportEloq->effective_bet += $effectiveBet;
            $reportEloq->win_money     += $gameProject->win_money;
            $reportEloq->our_net_win   += $gameProject->our_net_win;
        }
        return $reportEloq->save();
    }
}
