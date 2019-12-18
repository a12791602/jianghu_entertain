<?php

namespace App\ModelFilters\User;

use EloquentFilter\ModelFilter;

/**
 * 用户
 */
class FrontendUserFilter extends ModelFilter
{

    /**
     * Related Models that have ModelFilters as well as the method on the ModelFilter
     * As [relationMethod => [input_key1, input_key2]].
     *
     * @var array
     */
    public $relations = [];

    /**
     * 手机号查询
     *
     * @param  string $mobile 手机号码.
     * @return $this
     */
    public function mobile(string $mobile)
    {
        $eloq = $this->where('mobile', $mobile);
        return $eloq;
    }

    /**
     * 用户UID查询
     *
     * @param  string $userUid 用户唯一ID.
     * @return $this
     */
    public function userUid(string $userUid)
    {
        $eloq = $this->where('uid', $userUid);
        return $eloq;
    }

    /**
     * 是否测试用户
     *
     * @param  string $isTester 是否测试用户.
     * @return $this
     */
    public function isTester(string $isTester)
    {
        $eloq = $this->where('is_tester', $isTester);
        return $eloq;
    }

    /**
     * 上级查询
     *
     * @param  string $parentId 上级ID.
     * @return $this
     */
    public function parentId(string $parentId)
    {
        $eloq = $this->where('parent_id', $parentId);
        return $eloq;
    }

    /**
     * 在线状态查询
     *
     * @param  string $isOnline 用户唯一ID.
     * @return $this
     */
    public function isOnline(string $isOnline)
    {
        $eloq = $this->where('is_online', $isOnline);
        return $eloq;
    }

    /**
     * 最后登陆IP查询
     *
     * @param  string $lastLoginIp 最后登陆IP.
     * @return $this
     */
    public function lastLoginIp(string $lastLoginIp)
    {
        $eloq = $this->where('last_login_ip', $lastLoginIp);
        return $eloq;
    }

    /**
     * 注册IP查询
     *
     * @param  string $registerIp 注册IP.
     * @return $this
     */
    public function registerIp(string $registerIp)
    {
        $eloq = $this->where('register_ip', $registerIp);
        return $eloq;
    }

    /**
     * 注册时间查询
     *
     * @param  string $createAt 注册时间.
     * @return $this
     */
    public function createAt(string $createAt)
    {
        $createTime = json_decode($createAt, true);
        $eloq       = $this;
        if ($createTime !== null) {
            if (count($createTime) === 2) {
                $eloq = $this->whereBetween('created_at', $createTime);
            }
        }
        return $eloq;
    }
}
