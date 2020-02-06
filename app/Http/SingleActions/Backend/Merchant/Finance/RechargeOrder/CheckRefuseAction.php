<?php

namespace App\Http\SingleActions\Backend\Merchant\Finance\RechargeOrder;

use App\Models\Finance\SystemFinanceType;
use App\Models\Order\UsersRechargeOrder;
use Illuminate\Http\JsonResponse;

/**
 * Class CheckRefuseAction
 * @package App\Http\SingleActions\Backend\Merchant\Finance\RechargeOrder
 */
class CheckRefuseAction extends BaseAction
{
    /**
     * @param array $inputDatas InputDatas.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(array $inputDatas): JsonResponse
    {
        $order = $this->model::find($inputDatas['id']);
        if ($order->is_online !== SystemFinanceType::IS_ONLINE_NO) {
            throw new \Exception('202300');
        }
        if ($order->status !== UsersRechargeOrder::STATUS_CONFIRM) {
            throw new \Exception('202303');
        }
        $order->status   = UsersRechargeOrder::STATUS_REFUSE;
        $order->admin_id = $this->user->id;
        if ($order->save()) {
            $msgOut = msgOut();
            return $msgOut;
        }
        throw new \Exception('202304');
    }
}
