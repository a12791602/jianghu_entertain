<?php

namespace App\Http\SingleActions\Frontend\H5\Recharge;

use App\Models\Notification\MerchantNotificationStatistic;
use App\Models\User\UsersRechargeOrder;
use Illuminate\Http\JsonResponse;

/**
 * Class ConfirmAction
 * @package App\Http\SingleActions\Frontend\H5\Recharge
 */
class ConfirmAction extends BaseAction
{
    /**
     * @param array $inputData InputData.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(array $inputData): JsonResponse
    {
        $cache = $this->cache;
        $order = $this->order_item->where('order_no', $inputData['order_no'])->first();
        if (!$order instanceof UsersRechargeOrder) {
            throw new \Exception('101011');
        }
        if ((int) $order->is_online === UsersRechargeOrder::OFFLINE_FINANCE) {
            unset($order->expired_at);
            $order->bank          = $inputData['bank'] ?? null;
            $order->branch        = $inputData['branch'] ?? null;
            $order->card_number   = $inputData['card_number'] ?? null;
            $order->top_up_remark = $inputData['top_up_remark'] ?? null;
        }
        $order->status = UsersRechargeOrder::STATUS_CONFIRM;
        if (!$order->save()) {
            throw new \Exception('101004');
        }
        if ((int) $order->is_online === UsersRechargeOrder::OFFLINE_FINANCE) {
            merchantNotificationIncrement(MerchantNotificationStatistic::OFFLINE_TOP_UP);
        } else {
            merchantNotificationIncrement(MerchantNotificationStatistic::ONLINE_TOP_UP);
        }
        $remaining_today = mktime(23, 59, 59) - mktime((int) date('H'), (int) date('i'), (int) date('s'));
        $top_up_cache    = json_encode(
            [
             'user_id' => $this->user->id,
             'amount'  => (float) sprintf('%.2f', $order['money']),
            ],
            JSON_THROW_ON_ERROR | JSON_PRETTY_PRINT,
            512,
        );
        $cache->del($this->order_key . $order['money']);
        $cache->rpush('headquarters_statistics:top_up', $top_up_cache);
        $cache->expire('headquarters_statistics:top_up', $remaining_today);
        $cache->rpush('merchant_statistics_' . $this->user->platform_sign . ':top_up', $top_up_cache);
        $cache->expire('merchant_statistics_' . $this->user->platform_sign . ':top_up', $remaining_today);
        return msgOut();
    }
}
