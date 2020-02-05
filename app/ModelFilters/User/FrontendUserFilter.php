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
     * @return FrontendUserFilter
     */
    public function mobile(string $mobile): FrontendUserFilter
    {
        $eloq = $this->where('mobile', $mobile);
        return $eloq;
    }

    /**
     * 用户UID查询
     *
     * @param  string $userUid 用户唯一ID.
     * @return FrontendUserFilter
     */
    public function userUid(string $userUid): FrontendUserFilter
    {
        $eloq = $this->where('uid', $userUid);
        return $eloq;
    }

    /**
     * 是否测试用户
     *
     * @param  string $isTester 是否测试用户.
     * @return FrontendUserFilter
     */
    public function isTester(string $isTester): FrontendUserFilter
    {
        $eloq = $this->where('is_tester', $isTester);
        return $eloq;
    }

    /**
     * 上级查询
     *
     * @param  string $parentId 上级ID.
     * @return FrontendUserFilter
     */
    public function parentId(string $parentId): FrontendUserFilter
    {
        $eloq = $this->where('parent_id', $parentId);
        return $eloq;
    }

    /**
     * 在线状态查询
     *
     * @param  string $isOnline 用户唯一ID.
     * @return FrontendUserFilter
     */
    public function isOnline(string $isOnline): FrontendUserFilter
    {
        $eloq = $this->where('is_online', $isOnline);
        return $eloq;
    }

    /**
     * 最后登陆IP查询
     *
     * @param  string $lastLoginIp 最后登陆IP.
     * @return FrontendUserFilter
     */
    public function lastLoginIp(string $lastLoginIp): FrontendUserFilter
    {
        $eloq = $this->where('last_login_ip', $lastLoginIp);
        return $eloq;
    }

    /**
     * 注册IP查询
     *
     * @param  string $registerIp 注册IP.
     * @return FrontendUserFilter
     */
    public function registerIp(string $registerIp): FrontendUserFilter
    {
        $eloq = $this->where('register_ip', $registerIp);
        return $eloq;
    }

    /**
     * 注册时间查询
     *
     * @param  string $createAt 注册时间.
     * @return FrontendUserFilter
     */
    public function createAt(string $createAt): FrontendUserFilter
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

    /**
     * 按会员id搜索.
     *
     * @param string $guid 会员ID.
     * @return FrontendUserFilter
     */
    public function guid(string $guid): FrontendUserFilter
    {
        $eloq = $this->where('guid', $guid);
        return $eloq;
    }
}
