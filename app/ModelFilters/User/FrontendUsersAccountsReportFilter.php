<?php

namespace App\ModelFilters\User;

use EloquentFilter\ModelFilter;

/**
 * 用户账变记录
 */
class FrontendUsersAccountsReportFilter extends ModelFilter
{

    /**
     * Related Models that have ModelFilters as well as the method on the ModelFilter
     * As [relationMethod => [input_key1, input_key2]].
     *
     * @var array
     */
    public $relations = [];

    /**
     * 用户ID
     *
     * @param  integer $userId 用户ID.
     * @return FrontendUsersAccountsReportFilter
     */
    public function userId(int $userId): FrontendUsersAccountsReportFilter
    {
        return $this->where('user_id', $userId);
    }

    /**
     * 冻结类型
     *
     * @param  array $type 冻结类型.
     * @return FrontendUsersAccountsReportFilter
     */
    public function frozenTypeIn(array $type): FrontendUsersAccountsReportFilter
    {
        return $this->whereIn('frozen_type', $type);
    }

    /**
     * 账变时间
     *
     * @param  array $createdAt 账变时间.
     * @return FrontendUsersAccountsReportFilter
     */
    public function createdAt(array $createdAt): FrontendUsersAccountsReportFilter
    {
        $eloq = $this;
        if (count($createdAt) === 2) {
            $eloq = $this->wherebetween('created_at', $createdAt);
        }
        return $eloq;
    }

    /**
     * 账变类型
     *
     * @param  array $type 账变类型.
     * @return FrontendUsersAccountsReportFilter
     */
    public function typeIn(array $type): FrontendUsersAccountsReportFilter
    {
        return $this->whereIn('type_sign', $type);
    }
}
