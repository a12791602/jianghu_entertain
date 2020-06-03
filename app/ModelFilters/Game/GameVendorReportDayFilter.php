<?php

namespace App\ModelFilters\Game;

use EloquentFilter\ModelFilter;

/**
 * Class GameVendorReportDayFilter
 *
 * @package App\ModelFilters\Game
 */
class GameVendorReportDayFilter extends ModelFilter
{

    /**
     * Related Models that have ModelFilters as well as the method on the ModelFilter
     * As [relationMethod => [input_key1, input_key2]].
     *
     * @var array
     */
    public $relations = ['platform' => ['platform_name']];

    /**
     * 厂商标识查询
     * @param string $gameVendorSign 厂商标识.
     * @return self
     */
    public function gameVendorSign(string $gameVendorSign): self
    {
        return $this->where('game_vendor_sign', $gameVendorSign);
    }

    /**
     * 厂商名称模糊查询
     * @param string $gameVendorName 厂商名称.
     * @return self
     */
    public function gameVendorName(string $gameVendorName): self
    {
        return $this->whereLike('game_vendor_name', $gameVendorName);
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

    /**
     * 日期查询
     * @param array $projectDay 厂商标识.
     * @return self|\Illuminate\Database\Eloquent\Builder
     */
    public function projectDay(array $projectDay)
    {
        if (count($projectDay) === 1 && isset($projectDay[0])) {
            $eloq = $this->where('day', $projectDay[0]);
        } elseif (count($projectDay) === 2) {
            $eloq = $this->whereBetween('day', $projectDay);
        } else {
            $eloq = $this;
        }
        return $eloq;
    }
}
