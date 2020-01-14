<?php

namespace App\Finance\Pay\Core;

use App\Models\Order\UsersRechargeOrder;
use Illuminate\Support\Facades\Log;

/**
 * Trait CommonUnit
 * @package App\Finance\Pay\Core
 */
trait CommonUnit
{
    /**
     * 设置第三方平台需要的订单号.
     *
     * @param string $platformNeedNo 平台所需要的订单号.
     * @return void
     * @throws \Exception Exception.
     */
    public function setPlatformNeedNo(string $platformNeedNo): void
    {
        $result = UsersRechargeOrder::where('platform_sign', $this->payInfo['platformSign'])
            ->where('order_no', $this->payInfo['orderNo'])
            ->update(['platform_need_no' => $platformNeedNo]);
        if (!$result) {
            $this->writeLog('finance-recharge-system', $this->payInfo['orderNo'], '保存第三方所需要的订单号失败!');
            throw new \Exception('100304');
        }
    }

    /**
     * 得到待签名的字符串 key=value 形式.
     *
     * @param array  $data      数据.
     * @param string $sort      排序方式.
     * @param string $joiner    连接符.
     * @param string $secretKey 密钥的key.
     * @param string $secret    密钥.
     * @return string
     */
    public function generateToBeSignedString(
        array $data,
        string $sort,
        string $joiner,
        string $secretKey,
        string $secret
    ): string {
        $sort($data);
        $toBeSignedString = '';
        foreach ($data as $dataKey => $dataValue) {
            $toBeSignedString .= $dataKey . '=' . $dataValue . $joiner;
        }
        $toBeSignedString .= $secretKey . '=' . $secret;
        return $toBeSignedString;
    }

    /**
     * 跳转去支付.
     *
     * @param array  $data   支付的数据.
     * @param string $method 跳转的方法.
     * @return string
     */
    public function generateRedirectPayString(array $data, string $method): string
    {
        $html  = '<h3>正在建立安全链接中...</h3>' . PHP_EOL;
        $html .= '<form id="submit" name="submit" action="';
        $html .= $this->payInfo['requestUrl'] . '" method="' . $method . '" >' . PHP_EOL;
        foreach ($data as $dataKey => $dataValue) {
            $html .= '<input style="display:none;" name="' . $dataKey . '" value="' . $dataValue . '" />' . PHP_EOL;
        }
        $html .= '<input type="submit" value="提交" style="display:none;" />';
        $html .= '</form>' . PHP_EOL;
        $html .= '<script>document.forms["submit"].submit();</script>';
        return $html;
    }

    /**
     * 写日志.
     *
     * @param string $channel 通道.
     * @param string $orderNo 订单号.
     * @param string $msgs    消息.
     * @param array  $data    具体数据.
     * @return void
     */
    public function writeLog(string $channel, string $orderNo, string $msgs, array $data = []): void
    {
        Log::channel($channel)->info(['orderNo' => $orderNo, 'msg' => $msgs, 'data' => $data]);
    }
}
