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
     * @var mixed $channel
     */
    protected $channel;

    /**
     * 发起支付.
     *
     * @return mixed[]
     * @throws \Exception Exception.
     */
    public function recharge(): array
    {
        $data                 = [];
        $data['pay_memberid'] = $this->payInfo['merchantCode'];
        $platformNeedNo       = date('YmdHis') . $this->payInfo['orderNo'];
        $this->setPlatformNeedNo($platformNeedNo);
        $data['pay_orderid']            = $platformNeedNo;
        $data['pay_applydate']          = date('Y-m-d H:i:s');
        $data['pay_bankcode']           = $this->channel;
        $data['pay_notifyurl']          = $this->payInfo['callbackUrl'];
        $data['pay_callbackurl']        = $this->payInfo['redirectUrl'];
        $data['pay_amount']             = sprintf('%0.2f', $this->payInfo['money']);
        $signStr                        = $this->generateToBeSignedString(
            $data,
            'ksort',
            '&',
            'key',
            $this->payInfo['merchantSecret'],
        );
        $sign                           = strtoupper(md5($signStr));
        $data['pay_md5sign']            = $sign;
        $data['pay_returnType']         = 'html';
        $data['clientip']               = $this->payInfo['clientIp'];
        $html                           = $this->generateRedirectPayString($data, 'post');
        $this->returnData['payContent'] = $html;
        $this->returnData['mode']       = self::MODE_HTML;
        return $this->returnData;
    }

    /**
     * 校验返回参数.
     *
     * @param array $data Data.
     * @return mixed[]
     * @throws \Exception Exception.
     */
    public function verify(array $data): array
    {
        return $data;
    }
}
