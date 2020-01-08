<?php

namespace App\ModelFilters\System;

use EloquentFilter\ModelFilter;

/**
 * 运营商平台
 */
class SystemPlatformFilter extends ModelFilter
{

    /**
     * Related Models that have ModelFilters as well as the method on the ModelFilter
     * As [relationMethod => [input_key1, input_key2]].
     *
     * @var array
     */
    public $relations = [
        'owner' => ['email'],
    ];

    /**
     * 状态查询
     *
     * @param  string $status 状态.
     * @return $this
     */
    public function status(string $status): SystemPlatformFilter
    {
        $eloq = $this->where('status', $status);
        return $eloq;
    }

    /**
     * 生成时间
     *
     * @param  string $createdStr 生成时间.
     * @return $this
     */
    public function createdAt(string $createdStr): SystemPlatformFilter
    {
        $createdArr = json_decode($createdStr, true);
        if (!is_array($createdArr) || count($createdArr) !== 2) {
            $eloq = $this;
        } else {
            $eloq = $this->whereBetween('created_at', $createdArr);
        }
        return $eloq;
    }
}
