<?php

namespace App\Finance\Pay\Core;

use App\Models\Order\UsersRechargeOrder;

/**
 * Trait CommonUnit
 * @package App\Finance\Pay\Core
 */
trait CommonUnit
{
    /**
     * 设置第三方平台需要的订单号.
     *
     * @param string $platformNeedNo PlatformNeedNo.
     * @return void
     * @throws \Exception Exception.
     */
    public function setPlatformNeedNo(string $platformNeedNo): void
    {
        $result = UsersRechargeOrder::where('platform_sign', $this->payInfo['platformSign'])
            ->where('order_no', $this->payInfo['orderNo'])
            ->update(['platform_need_no' => $platformNeedNo]);
        if (!$result) {
            throw new \Exception('100304');
        }
    }

    /**
     * 得到待签名的字符串 key=value 形式.
     *
     * @param array  $data      Data.
     * @param string $sort      Sort.
     * @param string $joiner    Joiner.
     * @param string $secretKey SecretKey.
     * @param string $secret    Secret.
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
     * @param array  $data   Data.
     * @param string $method Method.
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
}
