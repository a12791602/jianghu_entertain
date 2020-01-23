<?php

namespace App\Lib\Crypt;

/**
 * RSA加解密
 */
class RsaCrypt
{

    /**
     * 公钥
     * @var string
     */
    private $publicKey;

    /**
     * 私钥
     * @var string
     */
    private $privateKey;

    /**
     * @param string $publicKey 公钥.
     * @return void
     */
    public function setPublicKey(string $publicKey): void
    {
        $this->publicKey = $publicKey;
    }

    /**
     * @param string $privateKey 私钥.
     * @return void
     */
    public function setPrivateKey(string $privateKey): void
    {
        $this->privateKey = $privateKey;
    }

    /**
     * RSA解密
     * @param  string $rsaData 需要解密的数据.
     * @throws \Exception Exception.
     * @return string
     */
    public function rsaDeCrypt(string $rsaData): string
    {
        $sslSign = openssl_pkey_get_private($this->privateKey);
        if (!$sslSign) {
            throw new \Exception('100608');
        }
        $baseRsa = base64_decode($rsaData);
        if (!$baseRsa) {
            throw new \Exception('100603');
        }
        $flag = openssl_private_decrypt($baseRsa, $deRsaCryptData, $this->privateKey);
        if ($flag === false) {
            throw new \Exception('100603');
        }
        return $deRsaCryptData;
    }

    /**
     * RSA加密
     * @param  mixed $data 需要加密的数据.
     * @throws \Exception Exception.
     * @return string
     */
    public function rsaEncrypt($data): string
    {
        $encrypt = openssl_public_encrypt($data, $encrypted, $this->publicKey);
        if ($encrypt === false) {
            throw new \Exception('100612');
        }
        return $encrypted;
    }

    /**
     * 组包
     * @param  string $encrypted 加密的数据.
     * @param  string $rsaKey    加密rsaKey.
     * @param  string $rsaIv     偏移量.
     * @param  string $splitFlag 随机组合字符串.
     * @return string
     */
    public function pack(
        string $encrypted,
        string $rsaKey,
        string $rsaIv,
        string $splitFlag
    ): string {
        $rsaKey  = $this->rsaEncrypt($rsaKey);
        $rsaIv   = $this->rsaEncrypt($rsaIv);
        $resData = $encrypted . $splitFlag . $rsaIv . $splitFlag . $rsaKey;
        return $resData;
    }
}
