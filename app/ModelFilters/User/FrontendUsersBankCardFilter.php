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
        return $this->where('id', $dataId);
    }

    /**
     * 用户ID
     *
     * @param  integer $userId 用户ID.
     * @return FrontendUsersBankCardFilter
     */
    public function userId(int $userId): FrontendUsersBankCardFilter
    {
        return $this->where('user_id', $userId);
    }

    /**
     * 银行ID
     *
     * @param  integer $bankId 银行ID.
     * @return FrontendUsersBankCardFilter
     */
    public function bank(int $bankId): FrontendUsersBankCardFilter
    {
        return $this->where('bank_id', $bankId);
    }

    /**
     * 平台标识
     *
     * @param  string $sign 平台标识.
     * @return FrontendUsersBankCardFilter
     */
    public function sign(string $sign): FrontendUsersBankCardFilter
    {
        return $this->where('platform_sign', $sign);
    }

    /**
     * 银行卡号
     *
     * @param  string $cardNumber 银行卡号.
     * @return FrontendUsersBankCardFilter
     */
    public function cardNumber(string $cardNumber): FrontendUsersBankCardFilter
    {
        return $this->where('card_number', $cardNumber);
    }

    /**
     * 绑定时间
     *
     * @param  array $createdAt 绑定时间.
     * @return FrontendUsersBankCardFilter
     */
    public function createdAt(array $createdAt): FrontendUsersBankCardFilter
    {
        if (!is_array($createdAt) || count($createdAt) !== 2) {
            $eloq = $this;
        } else {
            $eloq = $this->whereBetween('created_at', $createdAt);
        }
        return $eloq;
    }
}
