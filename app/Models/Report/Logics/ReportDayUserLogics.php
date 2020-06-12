<?php

namespace App\Models\Report\Logics;

use App\Models\Game\GameProject;
use App\Models\User\FrontendUser;
use Carbon\Carbon;
use Carbon\CarbonInterface;
use Illuminate\Support\Facades\DB;

trait ReportDayUserLogics
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
     * @return boolean
     */
    public static function saveGameReport(GameProject $gameProject): bool
    {
        $reportAt   = $gameProject->created_at->format('Y-m-d');
        $userReport = self::getUserReport(
            $gameProject->platform_sign,
            $gameProject->user->mobile,
            $gameProject->guid,
            $reportAt,
        );
        if ($userReport === null) {
            $effectiveBet = $gameProject->bet_money - $gameProject->win_money;
            $effectiveBet = $effectiveBet < 0 ? 0 : $effectiveBet;
            $addData      = [
                             'platform_sign'     => $gameProject->platform_sign,
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
        if ($userReport->save() === false) {
            return false;
        }
        $gameProject->is_counted_report = GameProject::COUNTED_REPORT_YES;
        return $gameProject->save();
    }

    /**
     * 用户日报表洗码字段
     * @param  FrontendUser    $user       用户.
     * @param  CarbonInterface $reportDay  日期.
     * @param  float           $userRebate 洗码返利.
     * @return boolean
     */
    public static function saveRebateReport(
        FrontendUser $user,
        CarbonInterface $reportDay,
        float $userRebate
    ): bool {
        $userReport = self::getUserReport($user->platform_sign, $user->mobile, $user->guid, $reportDay);
        if ($userReport === null) {
            $addData    = [
                           'platform_sign' => $user->platform_sign,
                           'mobile'        => $user->mobile,
                           'guid'          => $user->guid,
                           'rebate'        => $userRebate,
                           'day'           => $reportDay,
                          ];
            $userReport = new self();
            $userReport->fill($addData);
        } else {
            $userReport->rebate += $userRebate;
        }
        return $userReport->save();
    }

    /**
     * 用户佣金字段
     * @param  FrontendUser    $user           用户.
     * @param  CarbonInterface $reportDay      日期.
     * @param  float           $userCommission 洗码.
     * @return boolean
     */
    public static function saveCommissionReport(
        FrontendUser $user,
        CarbonInterface $reportDay,
        float $userCommission
    ): bool {
        $userReport = self::getUserReport($user->platform_sign, $user->mobile, $user->guid, $reportDay);
        if ($userReport === null) {
            $addData    = [
                           'platform_sign' => $user->platform_sign,
                           'mobile'        => $user->mobile,
                           'guid'          => $user->guid,
                           'commission'    => $userCommission,
                           'day'           => $reportDay,
                          ];
            $userReport = new self();
            $userReport->fill($addData);
        } else {
            $userReport->commission += $userCommission;
        }
        return $userReport->save();
    }
}
