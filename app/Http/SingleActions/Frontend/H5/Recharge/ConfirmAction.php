<?php

namespace App\Http\SingleActions\Frontend\H5\Recharge;

use App\Http\SingleActions\MainAction;
use App\Models\Notification\MerchantNotificationStatistic;
use App\Models\Order\UsersRechargeOrder;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Redis;

/**
 * Class ConfirmAction
 * @package App\Http\SingleActions\Frontend\H5\Recharge
 */
class ConfirmAction extends MainAction
{
    /**
     * @param array $inputData InputData.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(array $inputData): JsonResponse
    {
        $where = [
                  'platform_sign' => $this->user->platform_sign,
                  'order_no'      => $inputData['order_no'],
                  'user_id'       => $this->user->id,
                 ];
        $order = UsersRechargeOrder::where($where)->first();
        if (!$order) {
            throw new \Exception('101005');
        }
        if ($order->status !== UsersRechargeOrder::STATUS_INIT) {
            throw new \Exception('101003');
        }
        if ((int) $order->is_online === UsersRechargeOrder::OFFLINE_FINANCE) {
            $order->bank          = $inputData['bank'];
            $order->branch        = $inputData['branch'];
            $order->card_number   = $inputData['card_number'];
            $order->top_up_remark = $inputData['top_up_remark'] ?? null;
        }
        $order->status = UsersRechargeOrder::STATUS_CONFIRM;
        if ($order->save()) {
            if ((int) $order->is_online === UsersRechargeOrder::OFFLINE_FINANCE) {
                merchantNotificationIncrement(MerchantNotificationStatistic::OFFLINE_TOP_UP);
            } else {
                merchantNotificationIncrement(MerchantNotificationStatistic::ONLINE_TOP_UP);
            }
            $time         = mktime(23, 59, 59) - mktime((int) date('H'), (int) date('i'), (int) date('s'));
            $redis        = Redis::connection();
            $top_up_cache = json_encode(
                [
                 'user_id' => $this->user->id,
                 'amount'  => (float) sprintf('%.2f', $order['money']),
                ],
                JSON_THROW_ON_ERROR | JSON_PRETTY_PRINT,
                512,
            );
            $redis->rpush('headquarters_statistics:top_up', $top_up_cache);
            $redis->expire('headquarters_statistics:top_up', $time);
            $redis->rpush('merchant_statistics_' . $this->user->platform_sign . ':top_up', $top_up_cache);
            $redis->expire('merchant_statistics_' . $this->user->platform_sign . ':top_up', $time);
            return msgOut();
        }//end if
        throw new \Exception('101004');
    }
}
