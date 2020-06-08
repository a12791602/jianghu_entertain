<?php

namespace App\Models\Report\Logics;

use Carbon\Carbon;

trait ReportDayCompanyLogics
{
    /**
     * 生成或更新代理平台报表
     * @param  string $param  报表的字段名.
     * @param  float  $amount 金额.
     * @return boolean
     */
    public static function saveReport(
        string $param,
        float $amount
    ): bool {
        $reportDay      = Carbon::today();
        $filterArr      = ['report_day' => [$reportDay]];
        $platformReport = self::filter($filterArr)->first();
        if ($platformReport === null) {
            $platformReport = new self();
            $addData        = [
                               $param => $amount,
                               'day'  => $reportDay,
                              ];
            $platformReport->fill($addData);
        } else {
            $platformReport->$param += $amount;
        }//end if
        return $platformReport->save();
    }
}
