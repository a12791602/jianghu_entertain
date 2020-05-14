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
     * id查询
     *
     * @param  integer $dataId Id.
     * @return self
     */
    public function dataId(int $dataId): self
    {
        return $this->where('id', $dataId);
    }

    /**
     * 用户guid查询
     *
     * @param  string $guid 用户guid.
     * @return self
     */
    public function guid(string $guid): self
    {
        return $this->where('guid', $guid);
    }

    /**
     * 手机号码查询
     *
     * @param  string $mobile 手机号码.
     * @return self
     */
    public function mobile(string $mobile): self
    {
        return $this->where('mobile', $mobile);
    }

    /**
     * 拉黑时间查询
     *
     * @param  array $createdAt 拉黑时间.
     * @return $this|\Illuminate\Database\Eloquent\Builder
     */
    public function createdAt(array $createdAt)
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
     * @return self
     */
    public function status(int $status): self
    {
        return $this->where('status', $status);
    }

    /**
     * 平台标识查询
     *
     * @param  string $platformSign 平台标识.
     * @return self
     */
    public function platformSign(string $platformSign): self
    {
        return $this->where('platform_sign', $platformSign);
    }
}
