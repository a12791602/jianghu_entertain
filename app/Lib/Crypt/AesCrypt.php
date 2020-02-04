<?php

namespace App\Lib\Crypt;

/**
 * AES加解密
 */
class AesCrypt
{

    /**
     * 加密Key
     * @var string
     */
    private $aesKey;

    /**
     * 偏移量
     * @var string
     */
    private $aesIv;


    /**
     * @param string $aesKey 加密Key.
     * @param string $aesIv  偏移量.
     * @return void
     */
    public function __construct(string $aesKey, string $aesIv)
    {
        $this->aesKey = $aesKey;
        $this->aesIv  = $aesIv;
    }

    /**
     * AES加密
     * @param string $data 需要加密的数据.
     * @throws \Exception Exception.
     * @return string
     */
    public function aesEncrypt(string $data): string
    {
        $enAesData = base64_encode(
            openssl_encrypt(
                $data,
                'AES-128-CBC',
                $this->aesKey,
                OPENSSL_RAW_DATA,
                $this->aesIv,
            ),
        );
        if (!$enAesData) {
            throw new \Exception('100613');
        }
        return $enAesData;
    }

    /**
     * @param string $data 需要解密的数据.
     * @throws \Exception Exception.
     * @return mixed
     */
    public function aesDecrypt(string $data)
    {
        $deAesData = openssl_decrypt(
            base64_decode($data),
            'AES-128-CBC',
            $this->aesKey,
            OPENSSL_RAW_DATA,
            $this->aesIv,
        );
        if (!$deAesData) {
            throw new \Exception('100605');
        }
        return $deAesData;
    }
}
