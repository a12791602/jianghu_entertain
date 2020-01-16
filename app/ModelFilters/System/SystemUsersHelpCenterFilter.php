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
     * @return SystemUsersHelpCenterFilter
     */
    public function dataId(int $dataId): SystemUsersHelpCenterFilter
    {
        $eloq = $this->where('id', $dataId);
        return $eloq;
    }

    /**
     * 客户端类型
     *
     * @param  integer $type 客户端类型.
     * @return SystemUsersHelpCenterFilter
     */
    public function type(int $type): SystemUsersHelpCenterFilter
    {
        $eloq = $this->where('type', $type);
        return $eloq;
    }

    /**
     * 平台标识
     *
     * @param  string $sign 平台标识.
     * @return SystemUsersHelpCenterFilter
     */
    public function sign(string $sign): SystemUsersHelpCenterFilter
    {
        $eloq = $this->where('platform_sign', $sign);
        return $eloq;
    }
}
