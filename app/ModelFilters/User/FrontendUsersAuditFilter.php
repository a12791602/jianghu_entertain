<?php

namespace App\ModelFilters\User;

use EloquentFilter\ModelFilter;

/**
 * 用户稽核
 */
class FrontendUsersAuditFilter extends ModelFilter
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
     * @return FrontendUsersAuditFilter
     */
    public function guid(string $guid): FrontendUsersAuditFilter
    {
        return $this->where('guid', $guid);
    }

    /**
     * 用户账号
     *
     * @param  string $mobile 用户账号.
     * @return FrontendUsersAuditFilter
     */
    public function mobile(string $mobile): FrontendUsersAuditFilter
    {
        return $this->where('mobile', $mobile);
    }


    /**
     * 生成时间
     *
     * @param  array $createdAt 生成时间.
     * @return FrontendUsersAuditFilter
     */
    public function createdAt(array $createdAt): FrontendUsersAuditFilter
    {
        $eloq = $this;
        if (count($createdAt) === 2) {
            $eloq = $this->wherebetween('created_at', $createdAt);
        }
        return $eloq;
    }

    /**
     * 状态查询
     *
     * @param integer $status 状态.
     * @return FrontendUsersAuditFilter
     */
    public function status(int $status): FrontendUsersAuditFilter
    {
        return $this->where('status', $status);
    }

    /**
     * 平台标识查询
     *
     * @param  string $platformSign 平台标识.
     * @return FrontendUsersAuditFilter
     */
    public function platformSign(string $platformSign): FrontendUsersAuditFilter
    {
        return $this->where('platform_sign', $platformSign);
    }
}
