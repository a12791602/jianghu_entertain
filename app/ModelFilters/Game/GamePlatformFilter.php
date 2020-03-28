<?php

namespace App\ModelFilters\Game;

use EloquentFilter\ModelFilter;

/**
 * Class GamePlatformFilter
 * @package App\ModelFilters\Game
 */
class GamePlatformFilter extends ModelFilter
{
    
    /**
     * Related Models that have ModelFilters as well as the method on the ModelFilter
     * As [relationMethod => [input_key1, input_key2]].
     * @var array
     */
    public $relations = [
                         'games' => [
                                     'type_in',
                                     'sub_type_in',
                                    ],
                        ];

    /**
     * 状态查询
     * @param  integer $status Status.
     * @return GamePlatformFilter
     */
    public function status(int $status): GamePlatformFilter
    {
        $object = $this->where('status', $status);
        return $object;
    }

    /**
     * 平台查询
     * @param  integer $platformId PlatformId.
     * @return GamePlatformFilter
     */
    public function platform(int $platformId): GamePlatformFilter
    {
        $object = $this->where('platform_id', $platformId);
        return $object;
    }

    /**
     * 客户端 1.PC 2.H5 3.APP
     * @param  integer $device PlatformId.
     * @return GamePlatformFilter
     */
    public function device(int $device): GamePlatformFilter
    {
        $object = $this->where('device', $device);
        return $object;
    }
}
