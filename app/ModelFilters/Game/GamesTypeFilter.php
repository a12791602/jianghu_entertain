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
        $object = $this->where('status', $status);
        return $object;
    }

    /**
     * 名称查询
     * @param  string $name Name.
     * @return GamesTypeFilter
     */
    public function name(string $name): GamesTypeFilter
    {
        $object = $this->where('name', $name);
        return $object;
    }

    /**
     * 分类查询
     * @param integer $type_id TypeId.
     * @return GamesTypeFilter
     */
    public function type(int $type_id): GamesTypeFilter
    {
        $object = $this->where('games_types.id', $type_id);
        return $object;
    }
}
