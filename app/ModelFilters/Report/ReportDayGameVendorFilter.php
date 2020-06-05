<?php

namespace App\ModelFilters\Report;

use EloquentFilter\ModelFilter;

/**
 * 游戏厂商日总报表
 */
class ReportDayGameVendorFilter extends ModelFilter
{

    /**
     * Related Models that have ModelFilters as well as the method on the ModelFilter
     * As [relationMethod => [input_key1, input_key2]].
     *
     * @var array
     */
    public $relations = [];

    /**
     * 游戏厂商标识
     *
     * @param  string $sign 游戏厂商标识.
     * @return self
     */
    public function gameVendorSign(string $sign): self
    {
        return $this->where('game_vendor_sign', $sign);
    }

    /**
     * 日期
     *
     * @param  array $reportDay 注册时间.
     * @return self|\Illuminate\Database\Eloquent\Builder
     */
    public function reportDay(array $reportDay)
    {
        $eloq = $this;
        if (count($reportDay) === 2) {
            $eloq = $this->whereBetween('day', $reportDay);
        }
        if (count($reportDay) === 1 && isset($reportDay[0])) {
            $eloq = $this->whereDate('day', $reportDay[0]);
        }
        return $eloq;
    }
}
