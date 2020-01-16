<?php

namespace App\ModelFilters\Activity;

use EloquentFilter\ModelFilter;

/**
 * Class SystemBankFilter
 *
 * @package App\ModelFilters\Finance
 */
class SystemDynActivityFilter extends ModelFilter
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
     * @return SystemDynActivityFilter
     */
    public function status(int $status): SystemDynActivityFilter
    {
        $object = $this->where('status', $status);
        return $object;
    }

    /**
     * @param  string $name Name.
     * @return SystemDynActivityFilter
     */
    public function name(string $name): SystemDynActivityFilter
    {
        $object = $this->where('name', $name);
        return $object;
    }
}
