<?php

namespace App\ModelFilters\Game;

use EloquentFilter\ModelFilter;

/**
 * Class GameTypeFilter
 *
 * @package App\ModelFilters\Game
 */
class GameTypeFilter extends ModelFilter
{

    /**
     * Related Models that have ModelFilters as well as the method on the ModelFilter
     * As [relationMethod => [input_key1, input_key2]].
     *
     * @var array
     */
    public $relations = [];

    /**
     * 状态查询
     * @param  integer $status Status.
     * @return GameTypeFilter
     */
    public function status(int $status): GameTypeFilter
    {
        return $this->where('status', $status);
    }

    /**
     * 名称查询
     * @param  string $name Name.
     * @return GameTypeFilter
     */
    public function name(string $name): GameTypeFilter
    {
        return $this->where('name', $name);
    }

    /**
     * 分类查询
     * @param integer $type_id TypeId.
     * @return GameTypeFilter
     */
    public function type(int $type_id): GameTypeFilter
    {
        return $this->where('game_types.id', $type_id);
    }
}
