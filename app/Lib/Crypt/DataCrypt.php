<?php

namespace App\Lib\Crypt;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Str;

/**
 * 数据加密处理
 */
class DataCrypt
{
    /**
     * @param  mixed $data 需要处理的数据.
     * @return mixed
     */
    public static function handle($data)
    {
        $data = json_encode($data);
        if ($data) {
            $isCryptData = Request::get('is_crypt_data');
            if ((bool) $isCryptData === true) {
                $currentSsl = Request::get('current_platform_ssl');
                $cryptKey   = Str::random(16);
                $cryptIv    = Str::random(16);
                $aesCrypt   = new AesCrypt($cryptKey, $cryptIv);
                $enAesData  = $aesCrypt->aesEncrypt($data);
                $rsaCrypt   = new RsaCrypt();
                $rsaCrypt->setPublicKey($currentSsl->public_key_second);
                $resData = $rsaCrypt->pack($enAesData, $cryptKey, $cryptIv, $currentSsl->interval_str_second);
                $data    = ['data' => $resData];
            }
        }
        return $data;
    }
}
