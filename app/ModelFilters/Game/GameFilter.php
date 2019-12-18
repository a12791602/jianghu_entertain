<?php

namespace App\ModelFilters\Game;

use App\Models\Platform\GamesPlatform;
use EloquentFilter\ModelFilter;

/**
 * Class GameFilter
 *
 * @package App\ModelFilters\Game
 */
class GameFilter extends ModelFilter
{

    /**
     * Related Models that have ModelFilters as well as the method on the ModelFilter
     * As [relationMethod => [input_key1, input_key2]].
     *
     * @var array
     */
    public $relations = [];

    /**
     * 游戏查询
     * @param  integer $game_id Game_id.
     * @return GameFilter
     */
    public function game(int $game_id): GameFilter
    {
        $object = $this->where('id', $game_id);
        return $object;
    }

    /**
     * 厂商查询
     * @param  integer $vendor_id Vendor_id.
     * @return GameFilter
     */
    public function vendor(int $vendor_id): GameFilter
    {
        $object = $this->where('vendor_id', $vendor_id);
        return $object;
    }

    /**
     * 分类查询
     * @param  integer $type_id Type_id.
     * @return GameFilter
     */
    public function type(int $type_id): GameFilter
    {
        $object = $this->where('type_id', $type_id);
        return $object;
    }

    /**
     * 未分配给平台的游戏
     * @param  string $unassign_platform_sign Unassign_platform_sign.
     * @return GameFilter
     */
    public function unassignPlatformSign(string $unassign_platform_sign): GameFilter
    {
        $assignedGames = GamesPlatform::where('platform_sign', $unassign_platform_sign)
            ->get()
            ->pluck('game_sign')
            ->toArray();
        $object        = $this->whereNotIn('sign', $assignedGames);
        return $object;
    }

    /**
     * 已分配给平台的游戏
     * @param  string $assigned_platform_sign Assigned_platform_sign.
     * @return GameFilter
     */
    public function assignedPlatformSign(string $assigned_platform_sign): GameFilter
    {
        $assignedGames = GamesPlatform::where('platform_sign', $assigned_platform_sign)
            ->get()
            ->pluck('game_sign')
            ->toArray();
        $object        = $this->whereIn('sign', $assignedGames);
        return $object;
    }
}
