<?php

namespace App\ModelFilters\Report;

use EloquentFilter\ModelFilter;

/**
 * Class ReportDayUserGameFilter
 *
 * @package App\ModelFilters\Report
 */
class ReportDayUserGameFilter extends ModelFilter
{

    /**
     * Related Models that have ModelFilters as well as the method on the ModelFilter
     * As [relationMethod => [input_key1, input_key2]].
     *
     * @var array
     */
    public $relations = ['gameVendor' => ['game_vendor_name']];

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
     * 游戏标识查询
     * @param string $gameSign 游戏标识.
     * @return self
     */
    public function gameSign(string $gameSign): self
    {
        return $this->where('game_sign', $gameSign);
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
     * 用户ID
     * @param string $guid 用户ID.
     * @return self
     */
    public function guid(string $guid): self
    {
        return $this->where('guid', $guid);
    }

    /**
     * 手机号码
     * @param string $mobile 手机号码.
     * @return self
     */
    public function mobile(string $mobile): self
    {
        return $this->where('mobile', $mobile);
    }

    /**
     * 日期
     * @param  array $reportDay 日期.
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
