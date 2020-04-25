<?php

namespace App\ModelFilters\Systems;

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
        return $this->where('id', $dataId);
    }

    /**
     * 上级ID
     *
     * @param  integer $dataPid 上级ID.
     * @return SystemUsersHelpCenterFilter
     */
    public function dataPid(int $dataPid): SystemUsersHelpCenterFilter
    {
        return $this->where('pid', $dataPid);
    }

    /**
     * 客户端类型
     *
     * @param  integer $type 客户端类型.
     * @return SystemUsersHelpCenterFilter
     */
    public function type(int $type): SystemUsersHelpCenterFilter
    {
        return $this->where('type', $type);
    }

    /**
     * 状态
     *
     * @param  integer $status 客户端类型.
     * @return SystemUsersHelpCenterFilter
     */
    public function status(int $status): SystemUsersHelpCenterFilter
    {
        return $this->where('status', $status);
    }

    /**
     * 平台标识
     *
     * @param  string $sign 平台标识.
     * @return SystemUsersHelpCenterFilter
     */
    public function sign(string $sign): SystemUsersHelpCenterFilter
    {
        return $this->where('platform_sign', $sign);
    }

    /**
     * 标题模糊查询
     *
     * @param  string $title 客户端类型.
     * @return SystemUsersHelpCenterFilter
     */
    public function title(string $title): SystemUsersHelpCenterFilter
    {
        return $this->whereLike('title', $title);
    }
}
