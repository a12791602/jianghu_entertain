<?php

namespace App\Models\Report\Logics;

use App\Models\User\FrontendUser;
use Carbon\CarbonInterface;

trait ReportDayUserCommissionLogics
{

    /**
     * @param  FrontendUser    $agent       代理.
     * @param  FrontendUser    $user        用户.
     * @param  float           $userWinLose 用户输赢金额.
     * @param  float           $commission  佣金.
     * @param  integer         $level       代理层级.
     * @param  CarbonInterface $reportDay   日期.
     * @return boolean
     */
    public static function saveReport(
        FrontendUser $agent,
        FrontendUser $user,
        float $userWinLose,
        float $commission,
        int $level,
        CarbonInterface $reportDay
    ): bool {
        $filterArr        = [
                             'platform_sign' => $user->platform_sign,
                             'agent'         => $agent->id,
                             'guid'          => $user->guid,
                             'day'           => [$reportDay],
                            ];
        $commissionReport = self::filter($filterArr)->first();
        if ($commissionReport === null) {
            $commissionReport = new self();
            $addData          = [
                                 'platform_sign' => $user->platform_sign,
                                 'agent_id'      => $agent->id,
                                 'mobile'        => $user->mobile,
                                 'guid'          => $user->guid,
                                 'win_lose'      => $userWinLose,
                                 'commission'    => $commission,
                                 'level'         => $level,
                                 'day'           => $reportDay,
                                ];
            $commissionReport->fill($addData);
            return $commissionReport->save();
        }
        return true;
    }
}
