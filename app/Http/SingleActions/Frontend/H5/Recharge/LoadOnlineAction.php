<?php

namespace App\Http\SingleActions\Frontend\H5\Recharge;

use App\Http\SingleActions\MainAction;
use App\Models\Finance\SystemFinanceChannel;
use App\Models\Finance\SystemFinanceOnlineInfo;
use App\Models\User\FrontendUser;
use App\Models\User\UsersRechargeOrder;

/**
 * Class RechargeAction
 * @package App\Http\SingleActions\Frontend\H5\Recharge
 */
class LoadOnlineAction extends MainAction
{

    /**
     * @param array $inputData InputData.
     * @return mixed
     * @throws \RuntimeException Exception.
     */
    public function execute(array $inputData)
    {
        //生成订单数据
        if (! $this->user instanceof FrontendUser) {
            throw new \RuntimeException('100505');//用户不存在
        }
            $order = UsersRechargeOrder::filter($inputData)->first();
        if (!$order instanceof UsersRechargeOrder) {
            throw new \RuntimeException('101011');//充值订单不存在
        }
        $onlineChannel = $order->onlineInfo;
        if (!$onlineChannel instanceof SystemFinanceOnlineInfo) {
            throw new \RuntimeException('100300');//充值渠道异常,请联系客服!
        }
        $channel = $onlineChannel->channel;
        if (!$channel instanceof SystemFinanceChannel) {
            throw new \RuntimeException('100305');//充值通道异常,请联系客服!
        }
        try {
            $channelClass = $channel->getChannelClass($order);
        } catch (\Throwable $exception) {
            throw new \RuntimeException('100300');
        }
        $result = $channelClass->postRedirect();
        return view('recharge.loadOnline', ['result' => $result]);
    }
}
