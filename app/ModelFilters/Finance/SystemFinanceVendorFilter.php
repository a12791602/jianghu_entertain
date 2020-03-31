<?php

namespace App\ModelFilters\Finance;

use EloquentFilter\ModelFilter;

/**
 * Class SystemFinanceVendorFilter
 *
 * @package App\ModelFilters\Finance
 */
class SystemFinanceVendorFilter extends ModelFilter
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
     * @return SystemFinanceVendorFilter
     */
    public function status(int $status): SystemFinanceVendorFilter
    {
        return $this->where('status', $status);
    }

    /**
     * @param  string $name Name.
     * @return SystemFinanceVendorFilter
     */
    public function name(string $name): SystemFinanceVendorFilter
    {
        return $this->where('name', $name);
    }
}
