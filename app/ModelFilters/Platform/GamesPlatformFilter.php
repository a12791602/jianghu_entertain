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
                         'games'  => ['name'], //GameFilter
                         'vendor' => ['vendor_id'], //GameVendorFilter
                         'type'   => ['type_id'], //GameTypeFilter
                        ];

    /**
     * 根据平台标记查询
     * @param string $platform_id PlatformSign.
     * @return GamesPlatformFilter
     */
    public function platformId(string $platform_id): GamesPlatformFilter
    {
        $object = $this->where('platform_id', $platform_id);
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
     * @param integer $hot_new IsHot.
     * @return GamesPlatformFilter
     */
    public function hotNew(int $hot_new): GamesPlatformFilter
    {
        $object = $this->where('hot_new', $hot_new);
        return $object;
    }
}
