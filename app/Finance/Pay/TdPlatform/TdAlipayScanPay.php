<?php

namespace App\Finance\Pay\TdPlatform;

use App\Finance\Pay\Core\Payment;

/**
 * 天道支付 支付宝扫码
 * Class TdAlipayScanPay
 * @package App\Finance\Pay\TdPlatform
 */
class TdAlipayScanPay extends BasePay implements Payment
{

    /**
     * @var mixed $channel
     */
    protected $channel = 903;
}
