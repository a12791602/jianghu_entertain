<?php

namespace App\Http\SingleActions\Backend\Merchant\Finance\RechargeOrder;

use App\Models\Order\UsersRechargeOrder;

/**
 * Class BaseAction
 * @package App\Http\SingleActions\Backend\Merchant\Finance\RechargeOrder
 */
class BaseAction
{

    /**
     * @var UsersRechargeOrder $model
     */
    protected $model;

    /**
     * BaseAction constructor.
     * @param UsersRechargeOrder $usersRechargeOrder 订单模型.
     */
    public function __construct(UsersRechargeOrder $usersRechargeOrder)
    {
        $this->model = $usersRechargeOrder;
    }
}
