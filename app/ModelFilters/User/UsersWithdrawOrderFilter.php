<?php

namespace App\ModelFilters\User;

use EloquentFilter\ModelFilter;

/**
 * Class UsersRechargeOrderFilter
 * @package App\ModelFilters\User
 */
class UsersWithdrawOrderFilter extends ModelFilter
{

    /**
     * Related Models that have ModelFilters as well as the method on the ModelFilter
     * As [relationMethod => [input_key1, input_key2]].
     *
     * 关联 FrontendUserFilter
     * 关联 MerchantAdminUserFilter
     * @var array
     */
    public $relations = [
                         'user'     => [
                                        'mobile',
                                        'guid',
                                       ],
                         'reviewer' => ['reviewer'],
                         'admin'    => ['admin'],
                        ];

    /**
     * 根据平台标记查询.
     *
     * @param string $platform_sign PlatformSign.
     * @return UsersWithdrawOrderFilter
     */
    public function platformSign(string $platform_sign): UsersWithdrawOrderFilter
    {
        $object = $this->where('platform_sign', $platform_sign);
        return $object;
    }

    /**
     * 按状态.
     *
     * @param array $status_list StatusList.
     * @return UsersWithdrawOrderFilter
     */
    public function statusList(array $status_list): UsersWithdrawOrderFilter
    {
        $object = $this->whereIn('status', $status_list);
        return $object;
    }

    /**
     * 按订单号搜索.
     *
     * @param string $order_no 订单号.
     * @return UsersWithdrawOrderFilter
     */
    public function orderNo(string $order_no): UsersWithdrawOrderFilter
    {
        $object = $this->where('order_no', $order_no);
        return $object;
    }

    /**
     * 按收款帐号类型搜索.
     *
     * @param integer $account_type 收款帐号类型.
     * @return UsersWithdrawOrderFilter
     */
    public function accountType(int $account_type): UsersWithdrawOrderFilter
    {
        $object = $this->where('account_type', $account_type);
        return $object;
    }
    /**
     * 按申请时间.
     *
     * @param array $crated_at CreatedAt.
     * @return UsersWithdrawOrderFilter
     */
    public function createdAt(array $crated_at): UsersWithdrawOrderFilter
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
     * 根据状态查询.
     *
     * @param integer $status Status.
     * @return UsersWithdrawOrderFilter
     */
    public function status(int $status): UsersWithdrawOrderFilter
    {
        $object = $this->where('status', $status);
        return $object;
    }


    /**
     * 按审核时间.
     *
     * @param array $review_at ReviewAt.
     * @return UsersWithdrawOrderFilter
     */
    public function reviewAt(array $review_at): UsersWithdrawOrderFilter
    {
        $object = $this;
        $number = (int) count($review_at);
        if ($number === 1) {
            $object = $this->where('review_at', '>=', $review_at[0]);
        } elseif ($number === 2) {
            $object = $this
                ->where('review_at', '>=', $review_at[0])
                ->where('review_at', '<=', $review_at[1]);
        }
        return $object;
    }


    /**
     * 按操作时间.
     *
     * @param array $operation_at OperationAt.
     * @return UsersWithdrawOrderFilter
     */
    public function operationAt(array $operation_at): UsersWithdrawOrderFilter
    {
        $object = $this;
        $number = (int) count($operation_at);
        if ($number === 1) {
            $object = $this->where('review_at', '>=', $operation_at[0]);
        } elseif ($number === 2) {
            $object = $this
                ->where('review_at', '>=', $operation_at[0])
                ->where('review_at', '<=', $operation_at[1]);
        }
        return $object;
    }

    /**
     * 按是否稽核扣款搜索.
     *
     * @param integer $is_audit 是否稽核扣款.
     * @return UsersWithdrawOrderFilter
     */
    public function isAudit(int $is_audit): UsersWithdrawOrderFilter
    {
        $object = $this->where('is_audit', $is_audit);
        return $object;
    }
}
