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
     * @param  integer $status Status.
     * @return object
     */
    public function status(int $status): object
    {
        $object = $this->where('status', $status);
        return $object;
    }

    /**
     * @param  string $name Name.
     * @return object
     */
    public function name(string $name): object
    {
        $object = $this->where('name', $name);
        return $object;
    }

    /**
     * @param integer $vendor_id VendorId.
     * @return object
     */
    public function vendor(int $vendor_id): object
    {
        $object = $this->where('games_vendors.id', $vendor_id);
        return $object;
    }
}
