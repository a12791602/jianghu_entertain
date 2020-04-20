<?php

namespace App\Http\SingleActions\Frontend\App\Recharge;

use App\Http\SingleActions\MainAction;
use App\Models\Notification\MerchantNotificationStatistic;
use App\Models\Order\UsersRechargeOrder;
use Illuminate\Http\JsonResponse;

/**
 * Class ConfirmAction
 * @package App\Http\SingleActions\Frontend\App\Recharge
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
            if ((int) $order->is_online === UsersRechargeOrder::OFFLINE_FINANCE) {
                merchantNotificationIncrement(MerchantNotificationStatistic::OFFLINE_TOP_UP);
            } else {
                merchantNotificationIncrement(MerchantNotificationStatistic::ONLINE_TOP_UP);
            }
            return msgOut();
        }
        throw new \Exception('101004');
    }
}
