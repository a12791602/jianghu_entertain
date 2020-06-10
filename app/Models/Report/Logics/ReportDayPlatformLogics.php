<?php

namespace App\Models\Report\Logics;

use Carbon\Carbon;

trait ReportDayPlatformLogics
{
    /**
     * 生成或更新代理平台报表
     * @param  string $param  报表的字段名.
     * @param  float  $amount 金额.
     * @return void
     */
    public static function saveReport(
        string $param,
        float $amount
    ): void {
        $platformSign   = getCurrentPlatformSign();
        $reportDay      = Carbon::today();
        $filterArr      = [
                           'platform_sign' => $platformSign,
                           'report_day'    => [$reportDay],
                          ];
        $platformReport = self::filter($filterArr)->first();
        if ($platformReport === null) {
            $platformReport = new self();
            $addData        = [
                               'platform_sign' => $platformSign,
                               $param          => $amount,
                               'day'           => $reportDay,
                              ];
            $platformReport->fill($addData);
        } else {
            $platformReport->$param += $amount;
        }//end if
        $platformReport->save();
    }
}
