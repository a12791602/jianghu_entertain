<?php

namespace App\Http\SingleActions\Frontend\H5\Recharge;

use App\Http\SingleActions\MainAction;
use App\Models\Order\UsersRechargeOrder;
use Illuminate\Http\JsonResponse;

/**
 * Class ConfirmAction
 * @package App\Http\SingleActions\Frontend\H5\Recharge
 */
class ConfirmAction extends MainAction
{
    /**
     * @param array $inputDatas InputDatas.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(array $inputDatas): JsonResponse
    {
        $where = [
                  'platform_sign' => $this->user->platform_sign,
                  'order_no'      => $inputDatas['order_no'],
                  'user_id'       => $this->user->id,
                 ];
        $order = UsersRechargeOrder::where($where)->first();
        if (!$order) {
            throw new \Exception('101005');
        }
        if ($order->status !== UsersRechargeOrder::STATUS_INIT) {
            throw new \Exception('101003');
        }
        $order->status = UsersRechargeOrder::STATUS_CONFIRM;
        if ($order->save()) {
            return msgOut();
        }
        throw new \Exception('101004');
    }
}
