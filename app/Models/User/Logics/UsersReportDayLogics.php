<?php

namespace App\Models\User\Logics;

use App\Models\Game\GameProject;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

trait UsersReportDayLogics
{

    /**
     * @param  string  $platformSign 平台标识.
     * @param  integer $mobile       手机号.
     * @param  string  $guid         用户guid.
     * @param  string  $reportAt     报表日期.
     * @return self|null
     */
    public static function getUserReport(
        string $platformSign,
        int $mobile,
        string $guid,
        string $reportAt
    ): ?self {
        $filterArr = [
                      'platform_sign' => $platformSign,
                      'mobile'        => $mobile,
                      'guid'          => $guid,
                      'report_day'    => [$reportAt],
                     ];
        return self::filter($filterArr)->first();
    }
    
    /**
     * @param  integer $mobile 手机号码.
     * @param  string  $guid   用户UID.
     * @param  float   $amount 金额.
     * @param  integer $type   类型 1充值 2提现.
     * @throws \Exception Exception.
     * @return void
     */
    public static function saveAccountReport(
        int $mobile,
        string $guid,
        float $amount,
        int $type
    ): void {
        $reportAt     = Carbon::now()->format('Y-m-d');
        $platformSign = getCurrentPlatformSign();
        $userReport   = self::getUserReport($platformSign, $mobile, $guid, $reportAt);
        if ($userReport === null) {
            $userReport = new self();
            $addData    = [
                           'platform_sign' => $platformSign,
                           'mobile'        => $mobile,
                           'guid'          => $guid,
                           'day'           => $reportAt,
                          ];
            if ($type === 1) {
                $addData['recharge_sum'] = $amount;
                $addData['recharge_num'] = 1;
            }
            if ($type === 2) {
                $addData['withdraw_sum'] = $amount;
                $addData['withdraw_num'] = 1;
            }
            $userReport->fill($addData);
        } else {
            if ($type === 1) {
                $userReport->recharge_sum += $amount;
                $userReport->recharge_num += 1;
            }
            if ($type === 2) {
                $userReport->withdraw_sum += $amount;
                $userReport->withdraw_num += 1;
            }
        }//end if
        if ($userReport->save() === false) {
            DB::rollback();
            throw new \Exception('100207');
        }
    }

    /**
     * @param  GameProject $gameProject 游戏注单.
     * @return void
     */
    public static function saveGameReport(GameProject $gameProject): void
    {
        $platformSign = getCurrentPlatformSign();
        $reportAt     = $gameProject->created_at->format('Y-m-d');
        $userReport   = self::getUserReport($platformSign, $gameProject->user->mobile, $gameProject->guid, $reportAt);
        if ($userReport === null) {
            $effectiveBet = $gameProject->bet_money - $gameProject->win_money;
            $effectiveBet = $effectiveBet < 0 ? 0 : $effectiveBet;
            $addData      = [
                             'platform_sign'     => $platformSign,
                             'mobile'            => $gameProject->user->mobile ?? '',
                             'guid'              => $gameProject->guid,
                             'bet_sum'           => $gameProject->bet_money,
                             'bet_num'           => 1,
                             'effective_bet_sum' => $effectiveBet,
                             'commission'        => $gameProject->commission,
                             'game_win_sum'      => $gameProject->win_money,
                             'day'               => $reportAt,
                            ];
            $userReport   = new self();
            $userReport->fill($addData);
        } else {
            $effectiveBet = $gameProject->bet_money - $gameProject->win_money;
            $effectiveBet = $effectiveBet < 0 ? 0 : $effectiveBet;

            $userReport->bet_sum           += $gameProject->bet_money;
            $userReport->bet_num           += 1;
            $userReport->effective_bet_sum += $effectiveBet;
            $userReport->commission        += $gameProject->commission;
            $userReport->game_win_sum      += $gameProject->win_money;
        }//end if
        DB::beginTransaction();
        if ($userReport->save() === false) {
            DB::rollback();
            return;
        }
        $gameProject->is_counted_report = GameProject::COUNTED_REPORT_YES;
        if ($gameProject->save() === false) {
            DB::rollback();
        }
        DB::commit();
    }
}
