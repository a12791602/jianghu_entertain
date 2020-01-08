<?php

namespace App\ModelFilters\Finance;

use EloquentFilter\ModelFilter;

/**
 * Class SystemBankFilter
 *
 * @package App\ModelFilters\Finance
 */
class SystemBankFilter extends ModelFilter
{

    /**
     * Related Models that have ModelFilters as well as the method on the ModelFilter
     * As [relationMethod => [input_key1, input_key2]].
     *
     * @var array
     */
    public $relations = [];

    /**
     * 按状态搜索
     * @param integer $status Status.
     * @return SystemBankFilter
     */
    public function status(int $status): SystemBankFilter
    {
        $object = $this->where('status', $status);
        return $object;
    }

    /**
     * 按名称搜索
     * @param string $name Name.
     * @return SystemBankFilter
     */
    public function name(string $name): SystemBankFilter
    {
        $object = $this->where('name', $name);
        return $object;
    }
}
