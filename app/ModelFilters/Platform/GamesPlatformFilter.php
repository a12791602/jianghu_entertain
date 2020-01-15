<?php

namespace App\ModelFilters\Platform;

use EloquentFilter\ModelFilter;

/**
 * Class GamesPlatformFilter
 * @package App\ModelFilters\Platform
 */
class GamesPlatformFilter extends ModelFilter
{

    /**
     * Related Models that have ModelFilters as well as the method on the ModelFilter
     * As [relationMethod => [input_key1, input_key2]].
     *
     * @var array
     */
    public $relations = [
                         'games'  => ['name'],
                         'vendor' => ['vendor_id'],
                         'type'   => ['type_id'],
                        ];

    /**
     * 根据平台标记查询
     * @param string $platform_sign PlatformSign.
     * @return GamesPlatformFilter
     */
    public function platformSign(string $platform_sign): GamesPlatformFilter
    {
        $object = $this->where('platform_sign', $platform_sign);
        return $object;
    }

    /**
     * 根据设备查询
     * @param integer $device Device.
     * @return GamesPlatformFilter
     */
    public function device(int $device): GamesPlatformFilter
    {
        $object = $this->where('device', $device);
        return $object;
    }

    /**
     * 根据状态查询
     * @param integer $status Status.
     * @return GamesPlatformFilter
     */
    public function status(int $status): GamesPlatformFilter
    {
        $object = $this->where('status', $status);
        return $object;
    }

    /**
     * 根据是否热门查找
     * @param integer $is_hot IsHot.
     * @return GamesPlatformFilter
     */
    public function isHot(int $is_hot): GamesPlatformFilter
    {
        $object = $this->where('is_hot', $is_hot);
        return $object;
    }
}
