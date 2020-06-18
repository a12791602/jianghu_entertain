<?php

namespace App\Finance\Pay\TdPlatform;

use App\Finance\Pay\Core\Base;
use App\Finance\Pay\Core\Payment;
use App\Models\User\UsersRechargeOrder;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Str;

/**
 * Class TdPay
 * @package App\Finance\Pay\TdPlatform
 */
class TdPay extends Base implements Payment
{

    /**
     * 第三方通道标识.
     *
     * @var mixed $channelSign
     */
    protected $channelSign;

    /**
     * 报此类错误时继续请求只到成功.
     * @var string[]
     */
    protected $retryAbleErrorString = [
                                       '暂时没有可匹配的订单',
                                       '订单号重复',
                                      ];

    /**
     * 发起支付.
     *
     * @return mixed[]
     * @throws \Exception Exception.
     */
    public function recharge(): array
    {
        $prefix                   = Request::get('prefix');
        $routeParams              = [
                                     'platform_sign' => $this->payInfo['platformSign'],
                                     'order_no'      => $this->payInfo['orderNo'],
                                     'money'         => $this->payInfo['money'],
                                    ];
        $payOnlineUrl             = route(
            $prefix . '.recharge.load-online',
            $routeParams,
        );
        $this->returnData['url']  = $payOnlineUrl;
        $this->returnData['mode'] = self::MODE_JUMP;
        return $this->returnData;
    }

    /**
     * @return array<string,string>
     * @throws \Exception Exception.
     */
    protected function getData(): array
    {
        $data                 = [];
        $data['pay_memberid'] = $this->payInfo['merchantCode'];
        $platformNeedNo       = time() . $this->payInfo['orderNo'];
        $this->setPlatformNeedNo($platformNeedNo);
        $data['pay_orderid']       = $platformNeedNo;
        $data['pay_applydate']     = date('Y-m-d H:i:s');
        $data['pay_bankcode']      = $this->channelSign;
        $data['pay_notifyurl']     = $this->payInfo['callbackUrl'];
        $data['pay_callbackurl']   = $this->payInfo['redirectUrl'];
        $data['pay_amount']        = floatDC($this->payInfo['money']);
        $this->signature['before'] = $this->generateToBeSignedString(
            $data,
            'ksort',
            '&',
            'key',
            $this->payInfo['merchantSecret'],
        );
        $this->signature['after']  = strtoupper(md5($this->signature['before']));
        $data['pay_md5sign']       = $this->signature['after'];
        $data['pay_returnType']    = 'html';
        $data['clientip']          = $this->payInfo['clientIp'];
        return $data;
    }


    /**
     * Post Redirect Function.
     * @throws \RuntimeException Exception.
     * @return string
     */
    public function postRedirect(): string
    {
        $data       = [];
        $retLog     = [];
        $resultJson = [];
        $resultBody = null;
        $infoMsg    = '用户id: ' . $this->order->user_id;
        for ($i = 0; $i <= 100; $i++) {
            $data       = $this->getData();
            $response   = Http::asForm()->post($this->payInfo['requestUrl'], $data);
            $resultBody = $response->body();
            $resultJson = $response->json();
            $retLog     = [
                           'ok'          => $response->ok(),
                           'successful'  => $response->successful(),
                           'status'      => $response->status(),
                           'headers'     => $response->headers(),
                           'body'        => $resultBody,
                           'JsonBody'    => $resultJson,
                           'serverError' => $response->serverError(),
                           'clientError' => $response->clientError(),
                           'data'        => $data,
                          ];
            if ($resultJson['status'] !== 'error') {
                break;
            }
            $status = Str::contains($resultJson['msg'], $this->retryAbleErrorString);
            if (!$status) {
                break;
            }
            Log::channel('finance-recharge-detail')->info($infoMsg . '失败数据', $retLog);
        }//end for
        Log::channel('finance-recharge-detail')
            ->info($infoMsg . '请求' . $i . '次之后的数据', $retLog);
        if ($resultJson['status'] === 'error') {
            $this->_setOrderFail();
            throw new \RuntimeException($resultJson['msg'], 403);
        }
        if ($resultBody === null) {
            $this->_setOrderFail();
            throw new \RuntimeException('TD-OW000');
        }
        $this->_wiriteRequestLog($data);
        return $resultBody;
    }

    /**
     * 写最后的日志记录
     * @param array $data Pay Data To ThirdParty.
     * @return void
     */
    private function _wiriteRequestLog(array $data): void
    {
        $this->writeLog(
            'finance-recharge-data',
            $this->payInfo['orderNo'],
            '天道支付(支付宝扫码) 请求数据信息',
            $data,
        );
        $this->writeLog(
            'finance-recharge-data',
            '平台订单号=' . $this->payInfo['orderNo'] . ', 三方订单号=' . $data['pay_orderid'] ?? '',
            '天道支付(支付宝扫码) 支付签名信息',
            $this->signature,
        );
    }

    /**
     * @return boolean
     */
    private function _setOrderFail(): bool
    {
        $this->order->status = UsersRechargeOrder::STATUS_ONLINE_FAIL;
        return $this->order->save();
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
        }//end if
        $this->verifyData['backStr'] = 'OK';
        return $this->verifyData;
    }
}
