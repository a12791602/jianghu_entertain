<?php

namespace App\Http\SingleActions\Frontend\H5\Recharge;

use App\Http\SingleActions\MainAction;
use App\Models\Finance\SystemFinanceChannel;
use App\Models\Finance\SystemFinanceOnlineInfo;
use App\Models\User\UsersRechargeOrder;

/**
 * Class RechargeAction
 * @package App\Http\SingleActions\Frontend\H5\Recharge
 */
class LoadOnlineAction extends MainAction
{

    /**
     * @param array $inputData InputData.
     * @return string[]
     */
    public function execute(array $inputData): array
    {
        $order = UsersRechargeOrder::filter($inputData)->first();
        if (!$order instanceof UsersRechargeOrder) {
            return ['error_code' => '101011'];//充值订单不存在
        }
        $onlineChannel = $order->onlineInfo;
        if (!$onlineChannel instanceof SystemFinanceOnlineInfo) {
            return ['error_code' => '100300'];//充值渠道异常,请联系客服!
        }
        $channel = $onlineChannel->channel;
        if (!$channel instanceof SystemFinanceChannel) {
            return ['error_code' => '100305'];//充值通道异常,请联系客服!
        }
        try {
            $channelClass = $channel->getChannelClass($order);
        } catch (\Throwable $exception) {
            return ['error_code' => '100300'];
        }
        try {
            $result = $channelClass->postRedirect();
        } catch (\Throwable $e) {
            return ['error_code' => $e->getMessage()];
        }
        return ['result' => $result];
    }
}
