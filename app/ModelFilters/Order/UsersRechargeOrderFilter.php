<?php

namespace App\ModelFilters\Order;

use EloquentFilter\ModelFilter;

/**
 * Class UsersRechargeOrderFilter
 * @package App\ModelFilters\Order
 */
class UsersRechargeOrderFilter extends ModelFilter
{

    /**
     * Related Models that have ModelFilters as well as the method on the ModelFilter
     * As [relationMethod => [input_key1, input_key2]].
     *
     * 关联 FrontendUserFilter
     * @var array
     */
    public $relations = [
                         'user' => [
                                    'mobile',
                                    'guid',
                                    'is_tester',
                                   ],
                        ];

    /**
     * 根据平台标记查询.
     *
     * @param string $platform_sign PlatformSign.
     * @return UsersRechargeOrderFilter
     */
    public function platformSign(string $platform_sign): UsersRechargeOrderFilter
    {
        return $this->where('platform_sign', $platform_sign);
    }

    /**
     * 根据状态查询.
     *
     * @param integer $status Status.
     * @return UsersRechargeOrderFilter
     */
    public function status(int $status): UsersRechargeOrderFilter
    {
        return $this->where('status', $status);
    }

    /**
     * 按是否是线上金流搜索.
     *
     * @param integer $is_online 是否是线上.
     * @return UsersRechargeOrderFilter
     */
    public function isOnline(int $is_online): UsersRechargeOrderFilter
    {
        return $this->where('is_online', $is_online);
    }

    /**
     * 按创建时间.
     *
     * @param array $crated_at CreatedAt.
     * @return UsersRechargeOrderFilter
     */
    public function createdAt(array $crated_at): UsersRechargeOrderFilter
    {
        $object = $this;
        $number = (int) count($crated_at);
        if ($number === 1) {
            $object = $this->where('created_at', '>=', $crated_at[0]);
        } elseif ($number === 2) {
            $object = $this
                ->where('created_at', '>=', $crated_at[0])
                ->where('created_at', '<=', $crated_at[1]);
        }
        return $object;
    }

    /**
     * 按系统订单号搜索.
     *
     * @param string $order_no 系统订单号.
     * @return UsersRechargeOrderFilter
     */
    public function orderNo(string $order_no): UsersRechargeOrderFilter
    {
        return $this->where('order_no', $order_no);
    }

    /**
     * 按商户订单号搜索.
     *
     * @param string $platform_no 商户订单号.
     * @return UsersRechargeOrderFilter
     */
    public function platformNo(string $platform_no): UsersRechargeOrderFilter
    {
        return $this->where('platform_no', $platform_no);
    }

    /**
     * 按商户编号搜索.
     *
     * @param string $snap_merchant_no 商户编号.
     * @return UsersRechargeOrderFilter
     */
    public function snapMerchantNo(string $snap_merchant_no): UsersRechargeOrderFilter
    {
        return $this->where('snap_merchant_no', $snap_merchant_no);
    }

    /**
     * 按商户号搜索.
     *
     * @param string $snap_merchant_code 商户号.
     * @return UsersRechargeOrderFilter
     */
    public function snapMerchantCode(string $snap_merchant_code): UsersRechargeOrderFilter
    {
        return $this->where('snap_merchant_code', $snap_merchant_code);
    }

    /**
     * 按商户搜索.
     *
     * @param string $snap_merchant 商户.
     * @return UsersRechargeOrderFilter
     */
    public function snapMerchant(string $snap_merchant): UsersRechargeOrderFilter
    {
        return $this->where('snap_merchant', 'like', '%' . $snap_merchant . '%');
    }

    /**
     * 按支付方式搜索.
     *
     * @param integer $finance_type_id 支付方式.
     * @return UsersRechargeOrderFilter
     */
    public function financeType(int $finance_type_id): UsersRechargeOrderFilter
    {
        return $this->where('finance_type_id', $finance_type_id);
    }

    /**
     * 按入款帐号搜索.
     *
     * @param string $snap_account 入款帐号.
     * @return UsersRechargeOrderFilter
     */
    public function snapAccount(string $snap_account): UsersRechargeOrderFilter
    {
        return $this->where('snap_account', $snap_account);
    }
}
