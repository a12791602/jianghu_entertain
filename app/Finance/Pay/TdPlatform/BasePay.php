<?php

namespace App\Finance\Pay\TdPlatform;

use App\Finance\Pay\Core\Base;
use App\Finance\Pay\Core\Payment;

/**
 * Class BasePay
 * @package App\Finance\Pay\TdPlatform
 */
class BasePay extends Base implements Payment
{

    /**
     * 第三方通道.
     *
     * @var string $channel
     */
    protected $channel;

    /**
     * 发起支付.
     *
     * @return mixed
     */
    public function recharge()
    {
    }

    /**
     * 校验返回参数.
     *
     * @param array $data Data.
     * @return mixed[]
     */
    public function verify(array $data): array
    {
        return $data;
    }
}
