<?php

namespace App\ModelFilters\User;

use EloquentFilter\ModelFilter;

/**
 * 用户黑名单
 */
class FrontendUsersBlackListFilter extends ModelFilter
{

    /**
     * Related Models that have ModelFilters as well as the method on the ModelFilter
     * As [relationMethod => [input_key1, input_key2]].
     *
     * @var array
     */
    public $relations = [];

    /**
     * 用户guid查询
     *
     * @param  string $guid 用户guid.
     * @return FrontendUsersBlackListFilter
     */
    public function guid(string $guid): FrontendUsersBlackListFilter
    {
        $eloq = $this->where('guid', $guid);
        return $eloq;
    }

    /**
     * 手机号码查询
     *
     * @param  string $mobile 手机号码.
     * @return FrontendUsersBlackListFilter
     */
    public function mobile(string $mobile): FrontendUsersBlackListFilter
    {
        $eloq = $this->where('mobile', $mobile);
        return $eloq;
    }

    /**
     * 拉黑时间查询
     *
     * @param  array $createdAt 拉黑时间.
     * @return FrontendUsersBlackListFilter
     */
    public function createdAt(array $createdAt): FrontendUsersBlackListFilter
    {
        $eloq = $this;
        if (count($createdAt) === 2) {
            $eloq = $this->whereBetween('created_at', $createdAt);
        }
        return $eloq;
    }

    /**
     * 状态查询
     *
     * @param integer $status 状态.
     * @return FrontendUsersBlackListFilter
     */
    public function status(int $status): FrontendUsersBlackListFilter
    {
        $eloq = $this->where('status', $status);
        return $eloq;
    }

    /**
     * 平台标识查询
     *
     * @param  string $platformSign 平台标识.
     * @return FrontendUsersBlackListFilter
     */
    public function platformSign(string $platformSign): FrontendUsersBlackListFilter
    {
        $eloq = $this->where('platform_sign', $platformSign);
        return $eloq;
    }
}
