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
                                     'type_id',
                                     'vendor',
                                     'sub_type_id',
                                    ],
                        ];

    /**
     * 状态查询
     * @param  integer $status Status.
     * @return GamePlatformFilter
     */
    public function status(int $status): GamePlatformFilter
    {
        return $this->where('status', $status);
    }

    /**
     * 平台查询
     * @param  integer $platformId PlatformId.
     * @return GamePlatformFilter
     */
    public function platform(int $platformId): GamePlatformFilter
    {
        return $this->where('platform_id', $platformId);
    }

    /**
     * 客户端 1.PC 2.H5 3.APP
     * @param  integer $device PlatformId.
     * @return GamePlatformFilter
     */
    public function device(int $device): GamePlatformFilter
    {
        return $this->where('device', $device);
    }

    /**
     * 热门游戏
     * @param  integer $hot_new HotNew.
     * @return GamePlatformFilter
     */
    public function hotNew(int $hot_new): GamePlatformFilter
    {
        return $this->where('hot_new', $hot_new);
    }

    /**
     * 游戏ID
     * @param  integer $game_id 游戏ID.
     * @return GamePlatformFilter
     */
    public function game(int $game_id): GamePlatformFilter
    {
        return $this->where('game_id', $game_id);
    }
}
