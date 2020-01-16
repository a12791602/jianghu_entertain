<?php

namespace App\ModelFilters\User;

use EloquentFilter\ModelFilter;

/**
 * 用户标识
 */
class UsersTagFilter extends ModelFilter
{

    /**
     * Related Models that have ModelFilters as well as the method on the ModelFilter
     * As [relationMethod => [input_key1, input_key2]].
     *
     * @var array
     */
    public $relations = [];

    /**
     * 平台标识查询
     * @param  string $sign 平台标识.
     * @return UsersTagFilter
     */
    public function platformSign(string $sign): UsersTagFilter
    {
        $eloq = $this->where('platform_sign', $sign);
        return $eloq;
    }
}
