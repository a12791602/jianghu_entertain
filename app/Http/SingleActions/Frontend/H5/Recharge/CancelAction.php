<?php

namespace App\Http\SingleActions\Frontend\H5\Recharge;

use App\Models\User\UsersRechargeOrder;
use Illuminate\Http\JsonResponse;

/**
 * Class CancelAction
 * @package App\Http\SingleActions\Frontend\H5\Recharge
 */
class CancelAction extends BaseAction
{
    /**
     * @param array $inputData InputData.
     * @return JsonResponse
     * @throws \RuntimeException Exception.
     */
    public function execute(array $inputData): JsonResponse
    {
        $cache = $this->cache;
        $order = $this->order_item->where('order_no', $inputData['order_no'])->first();
        if (!$order instanceof UsersRechargeOrder) {
            throw new \RuntimeException('101011');
        }
        $cache->del($this->order_key . $order['money']);
        return msgOut();
    }
}
