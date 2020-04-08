<?php

namespace App\Http\Middleware;

use App\Lib\Crypt\AesCrypt;
use App\Lib\Crypt\RsaCrypt;
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
     * @var mixed
     */
    private $currentPlatformEloq;

    /**
     * 当前平台的SSL
     * @var mixed
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
        $request->attributes->add(['is_crypt_data' => $isCryptData]);
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
        //$host   = $request->server('HTTP_REFERER'); // https://www.learnku.com/laravel
        $host   = 'http://api.397017.com'; // 因yapi插件获取域名问题, 暂时先开白
        $strArr = explode('/', $host);              // [ 0 => "http:", 1 => "", 2 => "www.learnku.com", 3 => "laravel"]
        if (!is_array($strArr) || !isset($strArr[2])) {
            throw new \Exception('100611');
        }
        $domain     = $strArr[2]; // "www.learnku.com"
        $domainEloq = SystemDomain::where('domain', $domain)->first();
        if ($domainEloq === null) {
            throw new \Exception('100609');
        }
        //域名所属平台
        $this->currentPlatformEloq = $domainEloq->platform;
        if ($this->currentPlatformEloq === null) {
            throw new \Exception('100610');
        }
        $this->currentSSL = $this->currentPlatformEloq->sslKey;
        if ($this->currentSSL === null) {
            throw new \Exception('100602');
        }
        $request->attributes->add(['current_platform_eloq' => $this->currentPlatformEloq]);
        $request->attributes->add(['current_platform_ssl' => $this->currentSSL]);
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
        $requestCryptData = explode($this->currentSSL->interval_str_first, $inData);
        if (!is_array($requestCryptData) || count($requestCryptData) !== 3) {
            throw new \Exception('100601');
        }
        //开始数据解密   0加密的数据  1加密数据的值  2加密数据的键
        $data     = $requestCryptData[0];
        $aesCrypt = new RsaCrypt();
        $aesCrypt->setPrivateKey($this->currentSSL->private_key_first);
        $iValue    = $aesCrypt->rsaDeCrypt($requestCryptData[1]);
        $iKey      = $aesCrypt->rsaDeCrypt($requestCryptData[2]);
        $aesCrypt  = new AesCrypt($iKey, $iValue);
        $deAesData = $aesCrypt->aesDecrypt($data);
        $deData    = json_decode($deAesData, true);
        if (!$deData) {
            throw new \Exception('100604');
        }
        //给request重新赋值并删除加密的data数据
        $request->replace($deData);
        $request->attributes->add(['crypt_data' => $inData]);
        unset($request['data']);
    }
}
