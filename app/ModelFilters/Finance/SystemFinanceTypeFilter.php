<?php

namespace App\ModelFilters\Finance;

use EloquentFilter\ModelFilter;

/**
 * Class SystemFinanceTypeFilter
 *
 * @package App\ModelFilters\Finance
 */
class SystemFinanceTypeFilter extends ModelFilter
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
     * @return SystemFinanceTypeFilter
     */
    public function status(int $status): SystemFinanceTypeFilter
    {
        return $this->where('status', $status);
    }

    /**
     * 按名称搜索
     * @param  string $name Name.
     * @return SystemFinanceTypeFilter
     */
    public function name(string $name): SystemFinanceTypeFilter
    {
        return $this->where('name', $name);
    }

    /**
     * 按是否是线上金流搜索
     * @param integer $is_online IsOnline.
     * @return SystemFinanceTypeFilter
     */
    public function isOnline(int $is_online): SystemFinanceTypeFilter
    {
        return $this->where('is_online', $is_online);
    }

    /**
     * 按资金方向搜索.
     *
     * @param integer $direction 资金方向.
     * @return SystemFinanceTypeFilter
     */
    public function direction(int $direction): SystemFinanceTypeFilter
    {
        return $this->where('direction', $direction);
    }
}
