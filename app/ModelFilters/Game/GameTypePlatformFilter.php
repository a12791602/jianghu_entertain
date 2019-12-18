<?php

namespace App\ModelFilters\Game;

use EloquentFilter\ModelFilter;

/**
 * Class GameTypePlatformFilter
 * @package App\ModelFilters\Game
 */
class GameTypePlatformFilter extends ModelFilter
{

    /**
     * Related Models that have ModelFilters as well as the method on the ModelFilter
     * As [relationMethod => [input_key1, input_key2]].
     *
     * @var array
     */
    public $relations = [
        'gameType' => ['name'],
    ];

    /**
     * 状态查询
     * @param  integer $status Status.
     * @return GameTypePlatformFilter
     */
    public function status(int $status): GameTypePlatformFilter
    {
        $object = $this->where('status', $status);
        return $object;
    }

    /**
     * 平台查询
     * @param  integer $platform_id PlatformId.
     * @return GameTypePlatformFilter
     */
    public function platform(int $platform_id): GameTypePlatformFilter
    {
        $object = $this->where('platform_id', $platform_id);
        return $object;
    }

    /**
     * 设备查询
     * @param integer $device Device.
     * @return GameTypePlatformFilter
     */
    public function device(int $device): GameTypePlatformFilter
    {
        $object = $this->where('device', $device);
        return $object;
    }
}
