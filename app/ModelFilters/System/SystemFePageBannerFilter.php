<?php

namespace App\ModelFilters\System;

use EloquentFilter\ModelFilter;

/**
 * Class SystemFePageBannerFilter
 * @package App\ModelFilters\System
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
        $result = $this->where('flag', $flag);
        return $result;
    }

    /**
     * @param  string $status Status.
     * @return $this
     */
    public function status(string $status)
    {
        $result = $this->where('status', $status);
        return $result;
    }
}
