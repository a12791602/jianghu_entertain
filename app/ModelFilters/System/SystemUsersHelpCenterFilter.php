<?php

namespace App\ModelFilters\System;

use EloquentFilter\ModelFilter;

/**
 * 帮助设置
 */
class SystemUsersHelpCenterFilter extends ModelFilter
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
     * @return $this
     */
    public function dataId(int $dataId)
    {
        $eloq = $this->where('id', $dataId);
        return $eloq;
    }

    /**
     * 客户端类型
     *
     * @param  integer $type 客户端类型.
     * @return $this
     */
    public function type(int $type)
    {
        $eloq = $this->where('type', $type);
        return $eloq;
    }

    /**
     * 平台标识
     *
     * @param  string $sign 平台标识.
     * @return $this
     */
    public function sign(string $sign)
    {
        $eloq = $this->where('platform_sign', $sign);
        return $eloq;
    }
}
