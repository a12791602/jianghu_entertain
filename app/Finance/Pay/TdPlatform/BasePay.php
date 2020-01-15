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
        $data['pay_orderid']     = $platformNeedNo;
        $data['pay_applydate']   = date('Y-m-d H:i:s');
        $data['pay_bankcode']    = $this->channel;
        $data['pay_notifyurl']   = $this->payInfo['callbackUrl'];
        $data['pay_callbackurl'] = $this->payInfo['redirectUrl'];
        $data['pay_amount']      = sprintf('%0.2f', $this->payInfo['money']);
        $signStr                 = $this->generateToBeSignedString(
            $data,
            'ksort',
            '&',
            'key',
            $this->payInfo['merchantSecret'],
        );
        $sign                    = strtoupper(md5($signStr));
        $data['pay_md5sign']     = $sign;
        $data['pay_returnType']  = 'html';
        $data['clientip']        = $this->payInfo['clientIp'];
        $this->writeLog(
            'finance-recharge-data',
            $this->payInfo['orderNo'],
            '天道支付(支付宝扫码) 请求数据信息',
            $data,
        );
        $html                           = $this->generateRedirectPayString($data, 'post');
        $this->returnData['payContent'] = $html;
        $this->returnData['mode']       = self::MODE_HTML;
        $this->writeLog(
            'finance-recharge-sign',
            $this->payInfo['orderNo'],
            '天道支付(支付宝扫码) 支付签名信息',
            [
             'signBefore' => $signStr,
             'sign'       => $sign,
            ],
        );
        return $this->returnData;
    }

    /**
     * 校验返回参数.
     *
     * @param array $data 回调过来的参数.
     * @return mixed[]
     * @throws \Exception Exception.
     */
    public function verify(array $data): array
    {
        if ($data['returncode'] === '00') {
            $oldSign = $data['sign'];
            unset($data['sign'], $data['attach']);
            $signStr = $this->generateToBeSignedString(
                $data,
                'ksort',
                '&',
                'key',
                $this->payInfo['merchantSecret'],
            );
            $newSign = strtoupper(md5($signStr));
            $this->writeLog(
                'finance-callback-sign',
                $this->payInfo['orderNo'],
                '天道支付(支付宝扫码) 回调验签信息',
                [
                 'signBefore' => $signStr,
                 'oldSign'    => $oldSign,
                 'newSign'    => $newSign,
                ],
            );
            if ($oldSign === $newSign) {
                $this->verifyData['flag']            = true;
                $this->verifyData['realMoney']       = $data['amount'];
                $this->verifyData['merchantOrderNo'] = $data['transaction_id'];
            }
        }
        $this->verifyData['flag']    = true;
        $this->verifyData['backStr'] = 'OK';
        return $this->verifyData;
    }
}
