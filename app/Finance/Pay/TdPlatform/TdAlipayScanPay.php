<?php

namespace App\Finance\Pay\TdPlatform;

use App\Finance\Pay\Core\Payment;

/**
 * Class TdAlipayScanPay
 * @package App\Finance\Pay\TdPlatform
 */
class TdAlipayScanPay extends BasePay implements Payment
{

    /**
     * @var string $channel
     */
    protected $channel = 'alipay';
}
