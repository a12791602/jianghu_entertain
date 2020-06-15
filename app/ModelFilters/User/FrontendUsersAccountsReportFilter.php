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
    public $relations = [
                         'user'       => [
                                          'mobile',
                                          'guid',
                                         ],
                         'changeType' => ['frontend_display'],
                        ];

    /**
     * 用户ID
     *
     * @param  integer $userId 用户ID.
     * @return self
     */
    public function user(int $userId): self
    {
        return $this->where('user_id', $userId);
    }

    /**
     * 冻结类型
     *
     * @param  array $type 冻结类型.
     * @return self
     */
    public function frozenTypeIn(array $type): self
    {
        return $this->whereIn('frozen_type', $type);
    }

    /**
     * 账变时间
     *
     * @param  array $createdAt 账变时间.
     * @return self|\Illuminate\Database\Eloquent\Builder
     */
    public function createdAt(array $createdAt)
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
     * @return self
     */
    public function typeIn(array $type): self
    {
        return $this->whereIn('type_sign', $type);
    }

    /**
     * 平台标识
     *
     * @param  string $sign 平台标识.
     * @return self
     */
    public function platformSign(string $sign): self
    {
        return $this->where('platform_sign', $sign);
    }
}
