<?php

namespace App\ModelFilters\Report;

use EloquentFilter\ModelFilter;

/**
 * 用户单个游戏洗码日报表
 */
class ReportDayUserGameRebateFilter extends ModelFilter
{

    /**
     * Related Models that have ModelFilters as well as the method on the ModelFilter
     * As [relationMethod => [input_key1, input_key2]].
     *
     * @var array
     */
    public $relations = ['game' => ['game_name']];

    /**
     * 游戏标识
     *
     * @param  string $sign 游戏标识.
     * @return self
     */
    public function gameSign(string $sign): self
    {
        return $this->where('game_sign', $sign);
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

    /**
     * 按会员id搜索.
     *
     * @param string $guid 会员ID.
     * @return self
     */
    public function guid(string $guid): self
    {
        return $this->where('guid', $guid);
    }

    /**
     * 平台查询
     * @param string $platformSign 平台标识.
     * @return self
     */
    public function platformSign(string $platformSign): self
    {
        return $this->where('platform_sign', $platformSign);
    }
}
