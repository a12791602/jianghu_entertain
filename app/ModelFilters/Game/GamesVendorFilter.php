<?php

namespace App\ModelFilters\Game;

use EloquentFilter\ModelFilter;

/**
 * Class GamesVendorFilter
 *
 * @package App\ModelFilters\Game
 */
class GamesVendorFilter extends ModelFilter
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
     * @return GamesVendorFilter
     */
    public function status(int $status): GamesVendorFilter
    {
        return $this->where('status', $status);
    }

    /**
     * 名称查询
     * @param  string $name Name.
     * @return GamesVendorFilter
     */
    public function name(string $name): GamesVendorFilter
    {
        return $this->where('name', $name);
    }

    /**
     * 厂商查询
     * @param integer $vendor_id VendorId.
     * @return GamesVendorFilter
     */
    public function vendor(int $vendor_id): GamesVendorFilter
    {
        return $this->where('game_vendors.id', $vendor_id);
    }
}
