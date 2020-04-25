<?php

namespace App\ModelFilters\Game;

use EloquentFilter\ModelFilter;

/**
 * Class GamesTypeFilter
 *
 * @package App\ModelFilters\Game
 */
class GamesTypeFilter extends ModelFilter
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
     * @return GamesTypeFilter
     */
    public function status(int $status): GamesTypeFilter
    {
        return $this->where('status', $status);
    }

    /**
     * 名称查询
     * @param  string $name Name.
     * @return GamesTypeFilter
     */
    public function name(string $name): GamesTypeFilter
    {
        return $this->where('name', $name);
    }

    /**
     * 分类查询
     * @param integer $type_id TypeId.
     * @return GamesTypeFilter
     */
    public function type(int $type_id): GamesTypeFilter
    {
        return $this->where('game_types.id', $type_id);
    }
}
