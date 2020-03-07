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
        $object = $this->where('status', $status);
        return $object;
    }

    /**
     * 名称查询
     * @param  string $name Name.
     * @return GamesVendorFilter
     */
    public function name(string $name): GamesVendorFilter
    {
        $object = $this->where('name', $name);
        return $object;
    }

    /**
     * 厂商查询
     * @param integer $vendor_id VendorId.
     * @return GamesVendorFilter
     */
    public function vendor(int $vendor_id): GamesVendorFilter
    {
        $object = $this->where('game_vendors.id', $vendor_id);
        return $object;
    }
}
