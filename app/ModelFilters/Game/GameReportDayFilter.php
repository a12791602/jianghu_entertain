<?php

namespace App\ModelFilters\Game;

use EloquentFilter\ModelFilter;

/**
 * Class GameReportDayFilter
 *
 * @package App\ModelFilters\Game
 */
class GameReportDayFilter extends ModelFilter
{

    /**
     * Related Models that have ModelFilters as well as the method on the ModelFilter
     * As [relationMethod => [input_key1, input_key2]].
     *
     * @var array
     */
    public $relations = [];

    /**
     * 厂商查询
     * @param string $gameVendorSign 厂商标识.
     * @return self
     */
    public function gameVendorSign(string $gameVendorSign): self
    {
        return $this->where('game_vendor_sign', $gameVendorSign);
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
        if (count($projectDay) === 2) {
            $eloq = $this->whereBetween('day', $projectDay);
        } else {
            $eloq = $this;
        }
        return $eloq;
    }
}
