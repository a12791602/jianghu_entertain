<?php

namespace App\ModelFilters\System;

use EloquentFilter\ModelFilter;

/**
 * 管理员登录日志
 */
class BackendLoginLogFilter extends ModelFilter
{

    /**
     * Related Models that have ModelFilters as well as the method on the ModelFilter
     * As [relationMethod => [input_key1, input_key2]].
     *
     * @var array
     */
    public $relations = [];

    /**
     * 邮箱查询
     *
     * @param  string $email 邮箱.
     * @return BackendLoginLogFilter
     */
    public function email(string $email): BackendLoginLogFilter
    {
        $eloq = $this->where('email', $email);
        return $eloq;
    }

    /**
     * 用户名查询
     *
     * @param  string $name 用户名.
     * @return BackendLoginLogFilter
     */
    public function name(string $name): BackendLoginLogFilter
    {
        $eloq = $this->whereLike('name', $name);
        return $eloq;
    }

    /**
     * IP查询
     *
     * @param  string $loginIp IP.
     * @return BackendLoginLogFilter
     */
    public function loginIp(string $loginIp): BackendLoginLogFilter
    {
        $eloq = $this->where('ip', $loginIp);
        return $eloq;
    }

    /**
     * 登录时间查询
     *
     * @param  string $createdStr 登录时间.
     * @return BackendLoginLogFilter
     */
    public function createAt(string $createdStr): BackendLoginLogFilter
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
