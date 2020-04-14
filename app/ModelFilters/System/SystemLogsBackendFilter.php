<?php

namespace App\ModelFilters\System;

use EloquentFilter\ModelFilter;

/**
 * 后台操作日志
 */
class SystemLogsBackendFilter extends ModelFilter
{

    /**
     * Related Models that have ModelFilters as well as the method on the ModelFilter
     * As [relationMethod => [input_key1, input_key2]].
     *
     * @var array
     */
    public $relations = [];

    /**
     * 生成时间
     *
     * @param  array $createdAt 生成时间.
     * @return SystemLogsBackendFilter
     */
    public function createdAt(array $createdAt): SystemLogsBackendFilter
    {
        $eloq = $this;
        if (count($createdAt) === 2) {
            $eloq = $this->wherebetween('created_at', $createdAt);
        }
        return $eloq;
    }

    /**
     * IP
     *
     * @param  string $dataIp 数据IP.
     * @return SystemLogsBackendFilter
     */
    public function dataIp(string $dataIp): SystemLogsBackendFilter
    {
        return $this->where('ip', $dataIp);
    }

    /**
     * 管理员名称
     *
     * @param  string $name 管理员名称.
     * @return SystemLogsBackendFilter
     */
    public function adminName(string $name): SystemLogsBackendFilter
    {
        return $this->where('admin_name', $name);
    }
}
