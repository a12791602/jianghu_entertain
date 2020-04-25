<?php

namespace App\ModelFilters\Systems;

use EloquentFilter\ModelFilter;

/**
 * Class SystemFePageBannerFilter
 * @package App\ModelFilters\Systems
 */
class SystemFePageBannerFilter extends ModelFilter
{

    /**
     * Related Models that have ModelFilters as well as the method on the ModelFilter
     * As [relationMethod => [input_key1, input_key2]].
     *
     * @var array
     */
    public $relations = [];

    /**
     * @param  string $flag Flag.
     * @return $this
     */
    public function flag(string $flag)
    {
        return $this->where('flag', $flag);
    }

    /**
     * @param  string $status Status.
     * @return $this
     */
    public function status(string $status)
    {
        return $this->where('status', $status);
    }
}
