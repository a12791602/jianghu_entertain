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
        $eloq = $this->where('guid', $guid);
        return $eloq;
    }

    /**
     * 用户账号
     *
     * @param  string $mobile 用户账号.
     * @return FrontendUsersAuditFilter
     */
    public function mobile(string $mobile): FrontendUsersAuditFilter
    {
        $eloq = $this->where('mobile', $mobile);
        return $eloq;
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
        $eloq = $this->where('status', $status);
        return $eloq;
    }

    /**
     * 平台标识查询
     *
     * @param  string $platformSign 平台标识.
     * @return FrontendUsersAuditFilter
     */
    public function platformSign(string $platformSign): FrontendUsersAuditFilter
    {
        $eloq = $this->where('platform_sign', $platformSign);
        return $eloq;
    }
}
