<?php

namespace App\Http\SingleActions\Backend\Merchant\Finance\WithdrawOrder;

use App\Http\SingleActions\MainAction;
use App\Models\User\UsersWithdrawOrder;
use Illuminate\Http\Request;

/**
 * Class BaseAction
 * @package App\Http\SingleActions\Backend\Merchant\Finance\WithdrawOrder
 */
class BaseAction extends MainAction
{

    /**
     * @var UsersWithdrawOrder $model
     */
    protected $model;

    /**
     * BaseAction constructor.
     * @param UsersWithdrawOrder $usersWithdrawOrder 用户提现数据模型.
     * @param Request            $request            Request.
     */
    public function __construct(
        UsersWithdrawOrder $usersWithdrawOrder,
        Request $request
    ) {
        parent::__construct($request);
        $this->model = $usersWithdrawOrder;
    }
}
