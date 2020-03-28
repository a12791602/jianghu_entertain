<?php

namespace App\ModelFilters\Game;

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
     * @param  integer $typeId 分类ID.
     * @return GameFilter
     */
    public function type(int $typeId): GameFilter
    {
        $object = $this->where('type_id', $typeId);
        return $object;
    }

    /**
     * 分类查询
     * @param  array $typeId 分类ID.
     * @return GameFilter
     */
    public function typeIn(array $typeId): GameFilter
    {
        $object = $this->whereIn('type_id', $typeId);
        return $object;
    }

    /**
     * 子分类查询
     * @param  array $typeId 子分类ID.
     * @return GameFilter
     */
    public function subTypeIn(array $typeId): GameFilter
    {
        $object = $this->whereIn('sub_type_id', $typeId);
        return $object;
    }

    /**
     * 按名称.
     *
     * @param string $name Name.
     * @return GameFilter
     */
    public function name(string $name): GameFilter
    {
        $object = $this->where('name', $name);
        return $object;
    }
}
