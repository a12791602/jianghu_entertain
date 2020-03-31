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
     * 关联 GamesTypeFilter
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
        return $this->where('status', $status);
    }

    /**
     * 平台查询
     * @param  integer $platformId PlatformId.
     * @return GameTypePlatformFilter
     */
    public function platform(int $platformId): GameTypePlatformFilter
    {
        return $this->where('platform_id', $platformId);
    }

    /**
     * 设备查询
     * @param integer $device Device.
     * @return GameTypePlatformFilter
     */
    public function device(int $device): GameTypePlatformFilter
    {
        return $this->where('device', $device);
    }
}
