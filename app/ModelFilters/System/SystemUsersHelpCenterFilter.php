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
     * 状态
     *
     * @param  integer $status 客户端类型.
     * @return SystemUsersHelpCenterFilter
     */
    public function status(int $status): SystemUsersHelpCenterFilter
    {
        $eloq = $this->where('status', $status);
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

    /**
     * 标题模糊查询
     *
     * @param  string $title 客户端类型.
     * @return SystemUsersHelpCenterFilter
     */
    public function title(string $title): SystemUsersHelpCenterFilter
    {
        $eloq = $this->whereLike('title', $title);
        return $eloq;
    }
}
