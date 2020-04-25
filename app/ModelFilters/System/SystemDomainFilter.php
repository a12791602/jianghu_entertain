<?php

namespace App\ModelFilters\System;

use EloquentFilter\ModelFilter;

/**
 *  Class GameFilter
 *
 * @package App\ModelFilters\Game
 */
class SystemDomainFilter extends ModelFilter
{

    /**
     * Related Models that have ModelFilters as well as the method on the ModelFilter
     * As [relationMethod => [input_key1, input_key2]].
     *
     * @var array
     */
    public $relations = [];

    /**
     * 平台标识
     * @param  string $sign 标识.
     * @return $this
     */
    public function sign(string $sign): SystemDomainFilter
    {
        return $this->where('platform_sign', $sign);
    }

    /**
     * 类型
     * @param  integer $type 类型.
     * @return $this
     */
    public function type(int $type): SystemDomainFilter
    {
        return $this->where('type', $type);
    }

    /**
     * 状态
     * @param  integer $status 状态.
     * @return $this
     */
    public function status(int $status): SystemDomainFilter
    {
        return $this->where('status', $status);
    }

    /**
     * 域名
     * @param  string $domain 域名.
     * @return $this
     */
    public function domain(string $domain): SystemDomainFilter
    {
        return $this->where('domain', $domain);
    }

    /**
     * 生成时间
     * @param  array $createdAt 生成时间.
     * @return $this
     */
    public function createdAt(array $createdAt): SystemDomainFilter
    {
        if (count($createdAt) === 2) {
            $eloq = $this->whereBetween('created_at', $createdAt);
        } else {
            $eloq = $this;
        }
        return $eloq;
    }
}
