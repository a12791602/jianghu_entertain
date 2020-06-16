<?php

namespace App\Finance\Pay\Core;

use App\Models\Finance\SystemFinanceChannel;
use App\Models\Finance\SystemFinanceOnlineInfo;
use App\Models\User\UsersRechargeOrder;

/**
 * Class Base
 * @package App\Finance\Pay\Core
 */
abstract class Base implements Payment
{
    use RsaUnit;
    use DesUnit;
    use CommonUnit;

    public const MODE_JUMP   = 'jump'; //前端拿到链接直接跳转
    public const MODE_QRCODE = 'qrcode'; //前端拿到链接做成二维码展示,或者拿到二维码直接展示
    public const MODE_HTML   = 'html'; //前端拿到支付内容开一个新页面
    public const CALLBACK    = '/online-finance/callback/'; //回调的基础地址

    /**
     * 支付信息.
     *
     * @var array $payInfo
     */
    public $payInfo = [
                       'platformSign'    => null, //所属平台标记
                       'orderNo'         => null, //系统订单号
                       'money'           => null, //订单金额
                       'merchantCode'    => null, //商户号
                       'merchantSecret'  => null, //商户密钥
                       'publicKey'       => null, //第三方公钥
                       'privateKey'      => null, //第三方私钥
                       'requestUrl'      => null, //请求地址
                       'callbackUrl'     => null, //回调地址
                       'redirectUrl'     => null, //同步跳转地址
                       'appId'           => null, //终端号
//                       'user'            => null, //用户
                       'clientIp'        => null, //终端ip
                       'certificatePath' => null, //证书地址
                      ];

    /**
     * Signature For SingBefore and After
     * @var string[]
     */
    public $signature = [
                         'before' => '',
                         'after'  => '',
                        ];

    /**
     * request mode 为 0 时 返回的数据.
     *
     * @var array $returnData
     */
    public $returnData = [
                          'order_no' => null, //系统订单号 返回前端的字段所以是下划线
//                          'payContent' => null, //付款信息
                          'money'    => null, //订单金额
//                          'realMoney'  => null, //实际支付金额
                          'mode'     => null, //展示方式
                         ];

    /**
     * 验签完毕返回上层的数据.
     *
     * @var array $verifyData
     */
    public $verifyData = [
                          'flag'            => false, //验签是否成功的标记
                          'money'           => null, //订单金额
                          'realMoney'       => null, //实际支付金额
                          'orderNo'         => null, //系统订单号
                          'merchantOrderNo' => null, //商户订单号
                          'backStr'         => 'success', //返回给第三方的信息
                         ];

    /**
     * 第三方通道.
     *
     * @var mixed $channelSign
     */
    protected $channelSign;

    /**
     * 第三方通道.
     *
     * @var mixed $channel
     */
    protected $channel;

    /**
     * 订单
     * @var UsersRechargeOrder
     */
    protected $order;

    /**
     * @var SystemFinanceOnlineInfo
     */
    protected $onlineGateWay;

    /**
     * BasePay constructor.
     * @param SystemFinanceChannel $channel  SystemFinanceChannel Model.
     * @param UsersRechargeOrder   $order    UsersRechargeOrder  Model.
     * @param integer|null         $callback IsCallBack.
     * @throws \RuntimeException Exception.
     */
    public function __construct(
        SystemFinanceChannel $channel,
        UsersRechargeOrder $order,
        ?int $callback = 0
    ) {
        $this->channel       = $channel;
        $this->order         = $order;
        $this->onlineGateWay = $this->_getOnlineGateWaty();
        if ($callback) {
            $this->setPreDataOfVerify();
        } else {
            $this->setPreDataOfRecharge();
        }
    }

    /**
     * @return SystemFinanceOnlineInfo
     * @throws \RuntimeException Exception.
     */
    private function _getOnlineGateWaty(): SystemFinanceOnlineInfo
    {
        $onlineGateWay = $this->order->onlineInfo;
        if (!$onlineGateWay instanceof SystemFinanceOnlineInfo) {
            throw new \RuntimeException('100300');
        }
        return $onlineGateWay;
    }

    /**
     * 设置发起支付时的前置数据.
     * @return void
     */
    public function setPreDataOfRecharge(): void
    {
        //        $this->payInfo['user']            = $order->platform_sign . '_' . $order->user->username;
        $order                            = $this->order;
        $this->channelSign                = $this->channel->sign;
        $this->payInfo['platformSign']    = $order->platform_sign;
        $this->payInfo['orderNo']         = $order->order_no;
        $this->payInfo['money']           = $order->money;
        $this->payInfo['merchantCode']    = $this->onlineGateWay->merchant_code;
        $this->payInfo['merchantSecret']  = $this->onlineGateWay->merchant_secret;
        $this->payInfo['publicKey']       = $this->onlineGateWay->public_key;
        $this->payInfo['privateKey']      = $this->onlineGateWay->private_key;
        $this->payInfo['requestUrl']      = $this->onlineGateWay->request_url;
        $this->payInfo['callbackUrl']     = app('request')
                ->getSchemeAndHttpHost() . self::CALLBACK . $order->platform_sign . '/' . $order->order_no;
        $this->payInfo['redirectUrl']     = request()->headers->get('referer');
        $this->payInfo['appId']           = $this->onlineGateWay->app_id;
        $this->payInfo['clientIp']        = $order->client_ip;
        $this->payInfo['certificatePath'] = $this->onlineGateWay->certificate;
        $this->returnData['orderNo']      = $order->order_no;
        $this->returnData['money']        = $order->money;
    }

    /**
     * 设置发起验签时的前置数据.
     * @return void
     */
    public function setPreDataOfVerify(): void
    {
        $order                               = $this->order;
        $this->channelSign                   = $this->channel->sign;
        $this->payInfo['platformSign']       = $order->platform_sign;
        $this->payInfo['orderNo']            = $order->order_no;
        $this->payInfo['money']              = $order->money;
        $this->payInfo['merchantCode']       = $this->onlineGateWay->merchant_code;
        $this->payInfo['merchantSecret']     = $this->onlineGateWay->merchant_secret;
        $this->payInfo['publicKey']          = $this->onlineGateWay->public_key;
        $this->payInfo['privateKey']         = $this->onlineGateWay->private_key;
        $this->payInfo['appId']              = $this->onlineGateWay->app_id;
        $this->payInfo['clientIp']           = $order->client_ip;
        $this->payInfo['certificatePath']    = $this->onlineGateWay->certificate;
        $this->verifyData['money']           = $order->money;
        $this->verifyData['realMoney']       = $order->money;
        $this->verifyData['orderNo']         = $order->order_no;
        $this->verifyData['merchantOrderNo'] = $order->order_no;
    }
}
