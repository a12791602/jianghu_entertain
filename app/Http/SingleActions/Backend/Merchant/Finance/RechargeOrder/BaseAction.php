<?php

namespace App\Http\SingleActions\Backend\Merchant\Finance\RechargeOrder;

use App\Http\SingleActions\MainAction;
use App\Models\Order\UsersRechargeOrder;
use Illuminate\Http\Request;

/**
 * Class BaseAction
 * @package App\Http\SingleActions\Backend\Merchant\Finance\RechargeOrder
 */
class BaseAction extends MainAction
{

    /**
     * @var UsersRechargeOrder $model
     */
    protected $model;

    /**
     * BaseAction constructor.
     * @param UsersRechargeOrder $usersRechargeOrder 订单模型.
     * @param Request            $request            Request.
     */
    public function __construct(UsersRechargeOrder $usersRechargeOrder, Request $request)
    {
        parent::__construct($request);
        $this->model = $usersRechargeOrder;
    }
}
