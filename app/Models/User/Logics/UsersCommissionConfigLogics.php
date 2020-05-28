<?php

namespace App\Models\User\Logics;

use App\Models\User\FrontendUser;

trait UsersCommissionConfigLogics
{
    /**
     * 获取玩家当前游戏的洗码率
     * @param  FrontendUser $user           用户.
     * @param  string       $gameVendorSign 游戏厂商标识.
     * @param  float        $betSum         下注金额.
     * @return float
     */
    public static function getCommissionPercent(
        FrontendUser $user,
        string $gameVendorSign,
        float $betSum
    ): float {
        $commissionFilter = [
                             'platform_sign' => $user->platform_sign,
                             'game_vendor'   => $gameVendorSign,
                             'bet_egt'       => $betSum,
                            ];
        $commissionConfig = self::filter($commissionFilter)->orderBy('bet', 'desc')->first();
        if ($commissionConfig === null) {
            return 0;
        }
        $commissionEloq = $commissionConfig->configDetail->where('grade_id', $user->level_id)->first();
        if ($commissionEloq === null) {
            return 0;
        }
        return $commissionEloq->percent;
    }
}
