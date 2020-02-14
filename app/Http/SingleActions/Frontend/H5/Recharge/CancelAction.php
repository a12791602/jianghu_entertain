<?php

namespace App\Http\SingleActions\Frontend\H5\Recharge;

use App\Http\SingleActions\MainAction;
use App\Models\Order\UsersRechargeOrder;
use Illuminate\Http\JsonResponse;

/**
 * Class CancelAction
 * @package App\Http\SingleActions\Frontend\H5\Recharge
 */
class CancelAction extends MainAction
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
            throw new \Exception('101002');
        }
        if ($order->status !== UsersRechargeOrder::STATUS_INIT) {
            throw new \Exception('101000');
        }

        $order->status = UsersRechargeOrder::STATUS_CANCEL;
        if ($order->save()) {
            $msgOut = msgOut();
            return $msgOut;
        }
        throw new \Exception('101001');
    }
}
