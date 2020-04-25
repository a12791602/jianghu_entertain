<?php

namespace App\ModelFilters\System;

use EloquentFilter\ModelFilter;

/**
 * 客服设置
 */
class SystemCostomerServiceFilter extends ModelFilter
{

    /**
     * Related Models that have ModelFilters as well as the method on the ModelFilter
     * As [relationMethod => [input_key1, input_key2]].
     *
     * @var array
     */
    public $relations = [];

    /**
     * ID
     *
     * @param  integer $dataId ID.
     * @return SystemCostomerServiceFilter
     */
    public function dataId(int $dataId): SystemCostomerServiceFilter
    {
        return $this->where('id', $dataId);
    }

    /**
     * 客服类型
     *
     * @param  integer $type 客服类型.
     * @return SystemCostomerServiceFilter
     */
    public function type(int $type): SystemCostomerServiceFilter
    {
        return $this->where('type', $type);
    }

    /**
     * 平台标识
     *
     * @param  string $sign 平台标识.
     * @return SystemCostomerServiceFilter
     */
    public function sign(string $sign): SystemCostomerServiceFilter
    {
        return $this->where('platform_sign', $sign);
    }
}
