<?php

namespace App\Http\Middleware;

use App\Models\Systems\SystemDomain;
use Closure;
use Illuminate\Http\Request;

/**
 * 数据加密
 */
class Crypt
{

    /**
     * 当前平台
     * @var object App\Models\Systems\SystemPlatform
     */
    private $currentPlatformEloq;

    /**
     * 当前平台的SSL
     * @var object App\Models\Systems\SystemPlatformSsl
     */
    private $currentSSL;

    /**
     * Handle an incoming request.
     * @param Request $request 传递的参数.
     * @param Closure $next    Closure.
     * @throws \Exception Exception.
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        //获取当前域名所属平台
        $this->_getCurrentPlatform($request);

        //系统配置为不加密传输数据时直接放行
        $isCryptData = configure($this->currentPlatformEloq->sign, 'is_crypt_data');
        if (!$isCryptData) {
            //配置为不加密数据时传递的数据还是加密的，则返回100607让前端刷新该加密配置
            if (isset($request['data'])) {
                throw new \Exception('100607');
            }
            return $next($request);
        }
        //空参放行
        if (count($request->request) === 0) {
            return $next($request);
        }
        
        //数据解密处理
        $this->_dataHandle($request);
        
        return $next($request);
    }

    /**
     * 获取当前域名所属平台
     * @param  Request $request Request.
     * @throws \Exception Exception.
     * @return void
     */
    private function _getCurrentPlatform(Request $request): void
    {
        //获取来源域名
        $host   = $request->server('HTTP_REFERER'); // https://www.learnku.com/laravel
        $strArr = explode('/', $host);              // [ 0 => "http:", 1 => "", 2 => "www.learnku.com", 3 => "laravel"]
        if (!is_array($strArr) || !isset($strArr[2])) {
            throw new \Exception('100611');
        }
        $domain = $strArr[2]; // "www.learnku.com"
        //来源域名数据Eloq
        $domainEloq = SystemDomain::where('domain', $domain)->first();
        if (!$domainEloq) {
            throw new \Exception('100609');
        }
        //域名所属平台
        $this->currentPlatformEloq = $domainEloq->platform;
        if (!$this->currentPlatformEloq) {
            throw new \Exception('100610');
        }
        $this->currentSSL = $this->currentPlatformEloq->sslKey;
        if (!$this->currentSSL) {
            throw new \Exception('100602');
        }
        $request->attributes->add(['current_platform_eloq' => $this->currentPlatformEloq]);
    }

    /**
     * @param  Request $request 传递的参数.
     * @throws \Exception Exception.
     * @return void
     */
    private function _dataHandle(Request $request): void
    {
        //验证传输的数据是否合法
        $inData = $request->input('data');
        if (!$inData) {
            throw new \Exception('100606');
        }
        if (!is_string($inData)) {
            throw new \Exception('100600');
        }
        $requestCryptData = explode($this->currentSSL->interval_str, $inData);
        if (count($requestCryptData) !== 3) {
            throw new \Exception('100601');
        }
        //开始数据解密   0加密的数据  1加密数据的值  2加密数据的键
        $data      = $requestCryptData[0];
        $iValue    = self::_rsaDeCrypt($requestCryptData[1]);
        $iKey      = self::_rsaDeCrypt($requestCryptData[2]);
        $deAesData = self::_deAesCrypt($data, $iKey, $iValue);
        $deData    = json_decode($deAesData, true);
        if (!$deData) {
            throw new \Exception('100604');
        }
        //给request重新赋值并删除加密的data数据
        // $request->merge($deData);
        $request->replace($deData);
        $request->attributes->add(['crypt_data' => $inData]);
        unset($request['data']);
    }

    /**
     * RSA解密 自带私钥
     * @param  mixed $rsaData 数据.
     * @throws \Exception Exception.
     * @return string
     */
    private function _rsaDeCrypt($rsaData): string
    {
        $privateKey = $this->currentSSL->private_key;
        $sslSign    = openssl_pkey_get_private($privateKey);
        if (!$sslSign) {
            throw new \Exception('100608');
        }
        $baseRsa = base64_decode($rsaData);
        if (!$baseRsa) {
            throw new \Exception('100603');
        }
        $flag = openssl_private_decrypt($baseRsa, $deRsaCryptData, $privateKey);
        if ($flag === false) {
            throw new \Exception('100603');
        }
        return $deRsaCryptData;
    }

    /**
     * AES解密 加密方式 AES-128-CBC
     * @param  mixed $enAes   数据.
     * @param  mixed $dataKey 键.
     * @param  mixed $iValue  值.
     * @throws \Exception Exception.
     * @return string
     */
    private function _deAesCrypt($enAes, $dataKey, $iValue): string
    {
        $baseEnAes = base64_decode($enAes);
        $deAesData = openssl_decrypt((string) $baseEnAes, 'AES-128-CBC', $dataKey, OPENSSL_RAW_DATA, $iValue);
        if (!$deAesData) {
            throw new \Exception('100605');
        }
        return $deAesData;
    }
}
