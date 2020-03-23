<?php

namespace App\ModelFilters\User;

use EloquentFilter\ModelFilter;

/**
 * 用户
 */
class UsersLoginLogFilter extends ModelFilter
{

    /**
     * Related Models that have ModelFilters as well as the method on the ModelFilter
     * As [relationMethod => [input_key1, input_key2]].
     *
     * @var array
     */
    public $relations = [];

    /**
     * 用户UID查询
     *
     * @param  string $guid 用户UID.
     * @return UsersLoginLogFilter
     */
    public function guid(string $guid): UsersLoginLogFilter
    {
        $eloq = $this->where('guid', $guid);
        return $eloq;
    }

    /**
     * 手机号码查询
     *
     * @param  string $mobile 手机号码.
     * @return UsersLoginLogFilter
     */
    public function mobile(string $mobile): UsersLoginLogFilter
    {
        $eloq = $this->where('mobile', $mobile);
        return $eloq;
    }

    /**
     * 最后登陆IP查询
     *
     * @param  string $lastLoginIp 最后登陆IP.
     * @return UsersLoginLogFilter
     */
    public function lastLoginIp(string $lastLoginIp): UsersLoginLogFilter
    {
        $eloq = $this->where('last_login_ip', $lastLoginIp);
        return $eloq;
    }

    /**
     * 注册时间查询
     *
     * @param  array $createdAt 注册时间.
     * @return UsersLoginLogFilter
     */
    public function createdAt(array $createdAt): UsersLoginLogFilter
    {
        $eloq = $this;
        if (count($createdAt) === 2) {
            $eloq = $this->whereBetween('created_at', $createdAt);
        }
        return $eloq;
    }

    /**
     * 平台标识查询
     * @param  string $sign 平台标识.
     * @return UsersLoginLogFilter
     */
    public function platformSign(string $sign): UsersLoginLogFilter
    {
        $eloq = $this->where('platform_sign', $sign);
        return $eloq;
    }
}
