<?php

namespace App\ModelFilters\User;

use EloquentFilter\ModelFilter;

/**
 * 用户银行卡
 */
class FrontendUsersBankCardFilter extends ModelFilter
{

    /**
     * Related Models that have ModelFilters as well as the method on the ModelFilter
     * As [relationMethod => [input_key1, input_key2]].
     *
     * @var array
     */
    public $relations = ['user' => ['mobile']];

    /**
     * ID
     *
     * @param  integer $dataId ID.
     * @return FrontendUsersBankCardFilter
     */
    public function dataId(int $dataId): FrontendUsersBankCardFilter
    {
        $eloq = $this->where('id', $dataId);
        return $eloq;
    }

    /**
     * 用户ID
     *
     * @param  integer $userId 用户ID.
     * @return FrontendUsersBankCardFilter
     */
    public function userId(int $userId): FrontendUsersBankCardFilter
    {
        $eloq = $this->where('user_id', $userId);
        return $eloq;
    }

    /**
     * 银行ID
     *
     * @param  integer $bankId 银行ID.
     * @return FrontendUsersBankCardFilter
     */
    public function bankId(int $bankId): FrontendUsersBankCardFilter
    {
        $eloq = $this->where('bank_id', $bankId);
        return $eloq;
    }

    /**
     * 平台标识
     *
     * @param  string $sign 平台标识.
     * @return FrontendUsersBankCardFilter
     */
    public function sign(string $sign): FrontendUsersBankCardFilter
    {
        $eloq = $this->where('platform_sign', $sign);
        return $eloq;
    }

    /**
     * 绑定时间
     *
     * @param  string $createdStr 绑定时间.
     * @return FrontendUsersBankCardFilter
     */
    public function createdAt(string $createdStr): FrontendUsersBankCardFilter
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
