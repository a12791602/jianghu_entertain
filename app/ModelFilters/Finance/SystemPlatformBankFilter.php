<?php

namespace App\ModelFilters\Finance;

use EloquentFilter\ModelFilter;

/**
 * Class SystemPlatformBankFilter
 *
 * @package App\ModelFilters\Finance
 */
class SystemPlatformBankFilter extends ModelFilter
{

    /**
     * Related Models that have ModelFilters as well as the method on the ModelFilter
     * As [relationMethod => [input_key1, input_key2]].
     *
     * 关联 SystemBankFilter
     * @var array
     */
    public $relations = ['bank' => ['name']];

    /**
     * 按状态搜索
     * @param integer $status Status.
     * @return SystemPlatformBankFilter
     */
    public function status(int $status): SystemPlatformBankFilter
    {
        $object = $this->where('status', $status);
        return $object;
    }

    /**
     * 按平台标记搜索.
     *
     * @param string $platform_sign 平台标记.
     * @return SystemPlatformBankFilter
     */
    public function platformSign(string $platform_sign): SystemPlatformBankFilter
    {
        $object = $this->where('platform_sign', $platform_sign);
        return $object;
    }

    /**
     * 按银行卡号搜索.
     *
     * @param string $cardNumber 银行卡号.
     * @return SystemPlatformBankFilter
     */
    public function cardNumber(string $cardNumber): SystemPlatformBankFilter
    {
        $object = $this->where('card_number', $cardNumber);
        return $object;
    }
}
