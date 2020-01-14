<?php

namespace App\Finance\Pay\Core;

/**
 * Trait RsaUnit
 * @package App\Finance\Pay\Core
 */
trait RsaUnit
{

    /**
     * 公钥.
     *
     * @var resource $publicKey
     */
    protected $publicKeySource;

    /**
     * 私钥.
     *
     * @var resource $privateKey
     */
    protected $privateKeySource;

    /**
     * 密文
     *
     * @var string $ciphertext
     */
    protected $ciphertext;

    /**
     * 明文
     *
     * @var array $plaintext
     */
    protected $plaintext;

    /**
     * 签名.
     *
     * @var string $sign
     */
    protected $sign;

    /**
     * 设置公钥.
     *
     * @param string $publicKey 公钥.
     * @return RsaUnit
     * @throws \Exception Exception.
     */
    public function setPublicKey(string $publicKey): RsaUnit
    {
        $formatPublicKey = $this->formatPublicKey($publicKey); //格式化公钥
        $publicKeySource = openssl_pkey_get_public($formatPublicKey); //打开公钥资源
        if ($publicKeySource === false) {
            $this->writeLog('finance-recharge-system', $this->payInfo['orderNo'], '打开公钥资源失败!');
            throw new \Exception('100304');
        }
        $this->publicKeySource = $publicKeySource;
        return $this;
    }

    /**
     * 格式化公钥.
     *
     * @param string  $publicKey   格式化前的公钥.
     * @param integer $splitLength 每行的字符个数.
     * @return string
     */
    protected function formatPublicKey(string $publicKey, int $splitLength = 64): string
    {
        $formatPublicKey = '-----BEGIN PUBLIC KEY-----' . PHP_EOL;
        foreach (str_split($publicKey, $splitLength) as $chunk) {
            $formatPublicKey .= $chunk . PHP_EOL;
        }
        $formatPublicKey .= '-----END PUBLIC KEY-----';
        return $formatPublicKey;
    }

    /**
     * 设置私钥.
     *
     * @param string $privateKey 私钥.
     * @return RsaUnit
     * @throws \Exception Exception.
     */
    public function setPrivateKey(string $privateKey): RsaUnit
    {
        $formatPrivateKey = $this->formatPrivateKey($privateKey);
        $privateKeySource = openssl_pkey_get_private($formatPrivateKey);
        if ($privateKeySource === false) {
            $formatPrivateKey = $this->formatPrivateKey($privateKey, 64, 'RSA');
            $privateKeySource = openssl_pkey_get_private($formatPrivateKey);
        }
        if ($privateKeySource === false) {
            $this->writeLog('finance-recharge-system', $this->payInfo['orderNo'], '打开私钥资源失败!');
            throw new \Exception('100304');
        }
        $this->privateKeySource = $privateKeySource;
        return $this;
    }

    /**
     * 格式化私钥.
     *
     * @param string  $privateKey  格式化前的私钥.
     * @param integer $splitLength 每行的字符个数.
     * @param string  $mode        模式.
     * @return string
     */
    protected function formatPrivateKey(string $privateKey, int $splitLength = 64, string $mode = ''): string
    {
        $header = '-----BEGIN PRIVATE KEY-----';
        $footer = '-----END PRIVATE KEY-----';
        if ($mode === 'RSA') {
            $header = '-----BEGIN RSA PRIVATE KEY-----';
            $footer = '-----END RSA PRIVATE KEY-----';
        }
        $formatPrivateKey = $header . PHP_EOL;
        foreach (str_split($privateKey, $splitLength) as $chunk) {
            $formatPrivateKey .= $chunk . PHP_EOL;
        }
        $formatPrivateKey .= $footer . PHP_EOL;
        return $formatPrivateKey;
    }

    /**
     * 使用公钥资源加密.
     *
     * @param array   $data    待加密的数据.
     * @param integer $padding 填充模式.
     * @return RsaUnit
     * @throws \Exception Exception.
     */
    public function encryptByPublicKey(array $data, int $padding = OPENSSL_PKCS1_PADDING): RsaUnit
    {
        if (!isset($this->publicKeySource)) {
            $this->writeLog('finance-recharge-system', $this->payInfo['orderNo'], '公钥资源不存在!');
            throw new \Exception('100304');
        }
        $morphToJson = json_encode($data);
        $crypto      = '';
        $splitLength = openssl_pkey_get_details($this->publicKeySource)['bits'] / 8 - 11;
        foreach (str_split($morphToJson, $splitLength) as $chunk) {
            openssl_public_encrypt($chunk, $encryptData, $this->publicKeySource, $padding);
            $crypto .= $encryptData;
        }
        $this->ciphertext = base64_encode($crypto);
        return $this;
    }

    /**
     * 使用私钥加密.
     *
     * @param array   $data    待加密的数据.
     * @param integer $padding 填充模式.
     * @return RsaUnit
     * @throws \Exception Exception.
     */
    public function encryptByPrivateKey(array $data, int $padding = OPENSSL_PKCS1_PADDING): RsaUnit
    {
        if (!isset($this->privateKeySource)) {
            $this->writeLog('finance-recharge-system', $this->payInfo['orderNo'], '私钥资源不存在!');
            throw new \Exception('100304');
        }
        $morphToJson = json_encode($data);
        $crypto      = '';
        $splitLength = openssl_pkey_get_details($this->privateKeySource)['bits'] / 8 - 11;
        foreach (str_split($morphToJson, $splitLength) as $chunk) {
            openssl_private_encrypt($chunk, $encryptData, $this->privateKeySource, $padding);
            $crypto .= $encryptData;
        }
        $this->ciphertext = base64_encode($crypto);
        return $this;
    }

    /**
     * 使用公钥解密.
     *
     * @param string  $data    待解密的数据.
     * @param integer $padding 填充模式.
     * @return RsaUnit
     * @throws \Exception Exception.
     */
    public function decryptByPublicKey(string $data, int $padding = OPENSSL_PKCS1_PADDING): RsaUnit
    {
        if (!isset($this->publicKeySource)) {
            $this->writeLog('finance-recharge-system', $this->payInfo['orderNo'], '公钥资源不存在!');
            throw new \Exception('100304');
        }
        $data        = base64_decode($data);
        $splitLength = openssl_pkey_get_details($this->publicKeySource) / 8;
        $decry       = '';
        foreach (str_split($data, $splitLength) as $chunk) {
            openssl_public_decrypt($chunk, $decryData, $this->publicKeySource, $padding);
            $decry .= $decryData;
        }
        $plaintext       = json_decode($decry, true);
        $this->plaintext = $plaintext;
        return $this;
    }

    /**
     * 使用私钥解密.
     *
     * @param string  $data    待解密的数据.
     * @param integer $padding 填充模式.
     * @return RsaUnit
     * @throws \Exception Exception.
     */
    public function decryptByPrivateKey(string $data, int $padding = OPENSSL_PKCS1_PADDING): RsaUnit
    {
        if (!isset($this->privateKeySource)) {
            $this->writeLog('finance-recharge-system', $this->payInfo['orderNo'], '私钥资源不存在!');
            throw new \Exception('100304');
        }
        $data        = base64_decode($data);
        $splitLength = openssl_pkey_get_details($this->privateKeySource) / 8;
        $decry       = '';
        foreach (str_split($data, $splitLength) as $chunk) {
            openssl_private_decrypt($chunk, $decryData, $this->privateKeySource, $padding);
            $decry .= $decryData;
        }
        $plaintext       = json_decode($decry, true);
        $this->plaintext = $plaintext;
        return $this;
    }

    /**
     * 私钥签名.
     *
     * @param string  $signStr       待签名的字符串.
     * @param integer $signature_alg 签名模式.
     * @return RsaUnit
     * @throws \Exception Exception.
     */
    public function grantSignByPrivateKey(string $signStr, int $signature_alg = OPENSSL_ALGO_SHA1): RsaUnit
    {
        if (!isset($this->privateKeySource)) {
            $this->writeLog('finance-recharge-system', $this->payInfo['orderNo'], '私钥资源不存在!');
            throw new \Exception('100304');
        }
        openssl_sign($signStr, $sign_info, $this->privateKeySource, $signature_alg);
        $sign       = base64_encode($sign_info);
        $this->sign = $sign;
        return $this;
    }

    /**
     * 公钥验证签名.
     *
     * @param string  $signStr       签名明文.
     * @param string  $sign          签名.
     * @param integer $signature_alg 签名模式.
     * @return boolean
     * @throws \Exception Exception.
     */
    public function verifySignByPublicKey(
        string $signStr,
        string $sign,
        int $signature_alg = OPENSSL_ALGO_SHA1
    ): bool {
        if (!isset($this->publicKeySource)) {
            $this->writeLog('finance-recharge-system', $this->payInfo['orderNo'], '公钥资源不存在!');
            throw new \Exception('100304');
        }
        $result = openssl_verify($signStr, $sign, $this->publicKeySource, $signature_alg);
        return (bool) $result;
    }

    /**
     * 获取密文.
     *
     * @return string
     */
    public function getCiphertext(): string
    {
        return $this->ciphertext;
    }

    /**
     * 获取明文.
     *
     * @return mixed[]
     */
    public function getPlaintext(): array
    {
        return $this->plaintext;
    }

    /**
     * 获取签名
     *
     * @return string
     */
    public function getSign(): string
    {
        return $this->sign;
    }
}
