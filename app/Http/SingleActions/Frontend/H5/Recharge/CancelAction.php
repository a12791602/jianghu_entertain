<?php

namespace App\Http\SingleActions\Frontend\H5\Recharge;

use App\Http\SingleActions\MainAction;
use App\Models\User\FrontendUser;
use App\Models\User\UsersRechargeOrder;
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
     * @throws \RuntimeException Exception.
     */
    public function execute(array $inputDatas): JsonResponse
    {
        if (! $this->user instanceof FrontendUser) {
            throw new \RuntimeException('100505');//用户不存在
        }
        $where = [
                  'platform_sign' => $this->user->platform_sign,
                  'order_no'      => $inputDatas['order_no'],
                  'user_id'       => $this->user->id,
                 ];
        $order = UsersRechargeOrder::where($where)->first();
        if (!$order) {
            throw new \RuntimeException('101002');
        }
        if ($order->status !== UsersRechargeOrder::STATUS_INIT) {
            throw new \RuntimeException('101000');
        }

        $order->status = UsersRechargeOrder::STATUS_CANCEL;
        if ($order->save()) {
            return msgOut();
        }
        throw new \RuntimeException('101001');
    }
}
