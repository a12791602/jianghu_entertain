<?php

namespace App\Finance\Pay\Core;

/**
 * Class Base
 * @package App\Finance\Pay\Core
 */
abstract class Base implements Payment
{
    use RsaUnit;
    use DesUnit;
    use CommonUnit;

    public const MODE_JUMP = 1; //前端拿到链接直接跳转
    public const MODE_SHOW = 0; //前端拿到链接做成二维码展示,或者拿到二维码直接展示
    public const CALLBACK  = '/online-finance/callback/'; //回调的基础地址

    /**
     * 支付信息.
     *
     * @var array $payInfo
     */
    public $payInfo = [
        'orderNo' => null, //系统订单号
        'money' => null, //订单金额
        'merchantCode' => null, //商户号
        'merchantSecret' => null, //商户密钥
        'publicKey' => null, //第三方公钥
        'privateKey' => null, //第三方私钥
        'requestUrl' => null, //请求地址
        'callbackUrl' => null, //回调地址
        'redirectUrl' => null, //同步跳转地址
        'appId' => null, //终端号
        'user' => null, //用户
        'clientIp' => null, //终端ip
        'certificatePath' => null, //证书地址
    ];

    /**
     * request mode 为 0 时 返回的数据
     *
     * @var array $returnData
     */
    protected $returnData = [
        'orderNo' => null, //系统订单号
        'payUrl' => null, //付款链接
        'qrcode' => null, //支付二维码
        'money' => null, //订单金额
        'real_money' => null, //实际支付金额
        'mode' => self::MODE_SHOW, //展示方式
    ];

    /**
     * 验签完毕返回上层的数据
     *
     * @var array $verifyData
     */
    protected $verifyData = [
        'flag' => false, //验签是否成功的标记
        'money' => null, //订单金额
        'real_money' => null, //实际支付金额
        'orderNo' => null, //系统订单号
        'merchantOrderNo' => null, //商户订单号
        'backStr' => 'success', //返回给第三方的信息
    ];

    /**
     * 设置发起支付时的前置数据
     *
     * @param object $data Data.
     * @return $this
     */
    public function setPreDataOfRecharge(object $data)
    {
        $this->payInfo['orderNo']        = $data->order_no;
        $this->payInfo['money']          = $data->money;
        $this->payInfo['merchantCode']   = $data->onlineInfo->merchant_code;
        $this->payInfo['merchantSecret'] = $data->onlineInfo->merchant_secret;
        $this->payInfo['publicKey']      = $data->onlineInfo->public_key;
        $this->payInfo['privateKey']     = $data->onlineInfo->private_key;
        $this->payInfo['callbackUrl']    = app('request')
                ->getSchemeAndHttpHost() . self::CALLBACK . $data->platform_sign . '/' . $data->order_no;
        if (isset($data->onlineInfo->vendor_url)) {
            $this->payInfo['callbackUrl'] = $data->onlineInfo->vendor_url;
        }
        $this->payInfo['redirectUrl']     = app('request')->getSchemeAndHttpHost();
        $this->payInfo['appId']           = $data->onlineInfo->app_id;
        $this->payInfo['user']            = $data->platform_sign . '_' . $data->user->username;
        $this->payInfo['clientIp']        = $data->client_ip;
        $this->payInfo['certificatePath'] = $data->onlineInfo->certificate;
        return $this;
    }

    /**
     * 设置发起验签时的前置数据.
     *
     * @param object $data Data.
     * @return $this
     */
    public function setPreDataOfVerify(object $data)
    {
        $this->payInfo['orderNo'] = $data->order_no;
        return $this;
    }
}
