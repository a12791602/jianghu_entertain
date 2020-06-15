<?php

namespace App\ModelFilters\Systems;

use EloquentFilter\ModelFilter;

/**
 * 前台操作日志
 */
class SystemLogsFrontendFilter extends ModelFilter
{

    /**
     * Related Models that have ModelFilters as well as the method on the ModelFilter
     * As [relationMethod => [input_key1, input_key2]].
     *
     * @var array
     */
    public $relations = ['user' => ['guid']];

    /**
     * 生成时间
     *
     * @param  array $createdAt 生成时间.
     * @return self|\Illuminate\Database\Eloquent\Builder
     */
    public function createdAt(array $createdAt)
    {
        $eloq = $this;
        if (count($createdAt) === 2) {
            $eloq = $this->whereBetween('created_at', $createdAt);
        }
        if (count($createdAt) === 1 && isset($createdAt[0])) {
            $eloq = $this->whereDate('created_at', $createdAt[0]);
        }
        return $eloq;
    }

    /**
     * 手机号码
     *
     * @param  string $mobile 手机号码.
     * @return self
     */
    public function mobile(string $mobile): self
    {
        return $this->where('mobile', $mobile);
    }

    /**
     * IP
     *
     * @param  string $dataIp 数据IP.
     * @return self
     */
    public function dataIp(string $dataIp): self
    {
        return $this->where('ip', $dataIp);
    }

    /**
     * 路由
     *
     * @param  array $route 路由.
     * @return self
     */
    public function routeName(array $route): self
    {
        return $this->whereIn('description->route->action->as', $route);
    }

    /**
     * 平台标识
     *
     * @param  string $sign 平台标识.
     * @return self
     */
    public function platformSign(string $sign): self
    {
        return $this->where('platform_sign', $sign);
    }
}
