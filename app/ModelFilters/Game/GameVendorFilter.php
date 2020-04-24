<?php

namespace App\ModelFilters\Game;

use EloquentFilter\ModelFilter;

/**
 * Class GameVendorFilter
 *
 * @package App\ModelFilters\Game
 */
class GameVendorFilter extends ModelFilter
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
     * @return GameVendorFilter
     */
    public function status(int $status): GameVendorFilter
    {
        return $this->where('status', $status);
    }

    /**
     * 名称查询
     * @param  string $name Name.
     * @return GameVendorFilter
     */
    public function name(string $name): GameVendorFilter
    {
        return $this->where('name', $name);
    }

    /**
     * 厂商查询
     * @param integer $vendor_id VendorId.
     * @return GameVendorFilter
     */
    public function vendor(int $vendor_id): GameVendorFilter
    {
        return $this->where('game_vendors.id', $vendor_id);
    }
}
