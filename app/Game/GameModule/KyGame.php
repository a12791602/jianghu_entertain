<?php

namespace App\Game\GameModule;

use App\Game\BaseGame;
use App\Http\SingleActions\MainAction;
use App\Models\Game\Game;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;

/**
 * Class KyGame
 * @package App\Game\Ky
 */
class KyGame extends BaseGame
{

    /**
     * @var string
     */
    private $apiUrl;

    /**
     * @var string
     */
    private $recordUrl;

    /**
     * 进入游戏.
     *
     * @param Game       $gameObj   GameObj.
     * @param MainAction $systemObj SysObj.
     * @return KyGame[]
     */
    public function game(Game $gameObj, MainAction $systemObj): array
    {
        $this->gameItem = $gameObj;
        $this->sysObj   = $systemObj;
        $result         = $this->_main();
        $data           = ['url' => $result];
        return $data;
    }

    /**
     * 上分.
     *
     * @return boolean
     */
    public function upScore(): bool
    {
        // TODO: Implement upScore() method.
        return false;
    }

    /**
     * 下分.
     *
     * @return boolean
     */
    public function downScore(): bool
    {
        // TODO: Implement downScore() method.
        return false;
    }

    /**
     * 检查用户余额.
     *
     * @return float
     */
    public function checkBalance(): float
    {
        // TODO: Implement checkBalance() method.
        return 0.00;
    }

    /**
     * 检查用户上下分订单是否成功.
     *
     * @return boolean
     */
    public function checkOrder(): bool
    {
        // TODO: Implement checkOrder() method.
        return false;
    }

    /**
     * 保存用户在第三方平台的打码注单.
     *
     * @return void
     */
    public function saveBetOrder(): void
    {
        // TODO: Implement saveBetOrder() method.
    }

    /**
     * @param integer $series Login or other types.
     * @return mixed
     */
    private function _main(int $series = 0)
    {
        $this->apiUrl    = 'https://api.ky039.com:443/channelHandle';
        $this->recordUrl = 'https://record.ky039.com:443/getRecordHandle';

        $gameUser   = $this->sysObj->getUser();
        $account    = $gameUser->guid;
        $money      = 0.00;//$gameUser->account->balance
        $timeObj    = now();
        $timestamp  = (int) $timeObj->getPreciseTimestamp(3);
        $time_str   = $timeObj->format('YmdHis');
        $ipAddress  = Request::ip();
        $agent      = $this->gameVendor->merchant_id;
        $orderId    = $agent . $time_str . $account;
        $paramArr   = $this->_createParams($series, $account, $money, $ipAddress, $orderId);
        $param      = http_build_query($paramArr);
        $redireUrl  = $series !== 6 ? $this->apiUrl : $this->recordUrl;
        $desKey     = $this->gameVendor->des_key;
        $md5Key     = $this->gameVendor->md5_key;
        $redireUrl .= '?' . http_build_query(
            [
             'agent'     => $agent,
             'timestamp' => $timestamp,
             'param'     => $this->desEncode($desKey, $param),
             'key'       => md5($agent . $timestamp . $md5Key),
            ],
        );
        $logInfo    = [
                       'games'  => $this->gameVendor->name . '=>' . $this->gameItem->name,
                       'params' => $param,
                       'url'    => $redireUrl,
                      ];
        Log::channel('game')->info('准备参数', $logInfo);
        $result = $this->sender($redireUrl);
        return $result;
    }

    /**
     * @param integer     $series    Login or other types.
     * @param string      $account   Guid.
     * @param float       $money     Money in float unit.
     * @param string|null $ipAddress Ip address.
     * @param string      $orderId   Order id.
     * @return mixed[]
     */
    private function _createParams(
        int $series,
        string $account,
        float $money,
        ?string $ipAddress,
        string $orderId
    ): array {
        $param = [];
        switch ($series) {
            case 0: // login
                $param = [
                          's'        => $series,
                          'account'  => $account,
                          'money'    => $money,
                          'lineCode' => $this->sysObj->currentPlatformEloq->sign,
                          'KindID'   => $this->gameItem->sign,
                          'ip'       => $ipAddress,
                          'orderid'  => $orderId,
                          'lang'     => 'zh-CN',
                         ];
                break;
            case 1: // query the money of account
            case 5: // check if the account is online
            case 7: // query the game's total coin or money
            case 8: // force one player offline
                $param = [
                          's'       => $series,
                          'account' => $account,
                         ];
                break;
            case 2: // charge the money of account
            case 3: // withdraw the money of account
                $param = [
                          's'       => $series,
                          'account' => $account,
                          'orderid' => $orderId,
                          'money'   => $money,
                          'ip'      => $ipAddress,
                         ];
                break;
            case 4: // query the order info by id
                $param = [
                          's'       => $series,
                          'orderid' => $orderId,
                         ];
                break;
            case 6: // query game scores
                $param = [
                          's'         => $series,
                          'startTime' => 'startTime',//'startTime' => get_param('startTime'),
                          'endTime'   => 'endTime',//'endTime'   => get_param('endTime'),
                         ];
                break;
        }
        return $param;
    }

    /**
     * @param string $desKey       Des Key.
     * @param string $strToEncrypt String To Encrypt.
     * @return string
     */
    protected function desEncode(string $desKey, string $strToEncrypt): string
    {
        $strToEncrypt = $this->pkcs5Pad(trim($strToEncrypt), 16);
        $encrypt_str  = openssl_encrypt($strToEncrypt, 'AES-128-ECB', $desKey, OPENSSL_RAW_DATA | OPENSSL_ZERO_PADDING);
        $result       = base64_encode((string) $encrypt_str);
        return $result;
    }

    /**
     * @param string $desKey      Key.
     * @param string $strToDecode String to Decode.
     * @return string
     */
    protected function desDecode(string $desKey, string $strToDecode): string
    {
        $strToDecode = base64_decode($strToDecode);
        $decrypt_str = openssl_decrypt($strToDecode, 'AES-128-ECB', $desKey, OPENSSL_RAW_DATA | OPENSSL_ZERO_PADDING);
        $dataUnpad   = $this->pkcs5Unpad((string) $decrypt_str);
        $result      = trim((string) $dataUnpad);
        return $result;
    }

    /**
     * @param string  $text      Trimed String.
     * @param integer $blocksize Block Size.
     * @return string
     */
    protected function pkcs5Pad(string $text, int $blocksize): string
    {
        $padding = $blocksize - (strlen($text) % $blocksize);
        $result  = $text . str_repeat(chr($padding), $padding);
        return $result;
    }

    /**
     * @param string $text Decrypted String.
     * @return boolean|string
     */
    protected function pkcs5Unpad(string $text)
    {
        $padding = ord($text[strlen($text) - 1]);
        if ($padding > strlen($text)) {
            return false;
        }
        if (strspn($text, chr($padding), strlen($text) - $padding) !== $padding) {
            return false;
        }
        $result = substr($text, 0, -1 * $padding);
        return $result;
    }

    /**
     * "status": 200,
     * "header": "text/plain;charset=utf8",
     * "body": {
     * "m": "/channelHandle",
     * "s": 100,
     * "d": {
     * "code": 0,
     * "url": "https://qdh5.ky8068.com/index.html?account=64421_1896731&token=eyJkYXRhIjoiNjQ0MjFfMTg5NjczMSIsImNyZWF0ZWQiOjE1ODI5NTU5MTAsImV4cCI6MTUwfQ==.LvQ7pw3Rnrzk8zA44W/D8UjRS/cLpCRolsmqEdIoLPU=&lang=zh-CN&route=hwss.ky039.com:443,wss.ky039.com:443&ld=https://loudou.ky039.com/statisticsHandle"
     * }
     * }
     * @param string $redireUrl Redirect Url.
     * @return \Illuminate\Support\Optional|mixed
     */
    protected function sender(string $redireUrl)
    {
        $agent         = $this->sysObj->getAgent()->getUserAgent();
        $client        = new Client();
        $redirectParam = [
                          'allow_redirects' => [
                                                'max'             => 10,        // allow at most 10 redirects.
                                                'strict'          => true,      // use "strict" RFC compliant redirects.
                                                'referer'         => true,      // add a Referer header
                                                'track_redirects' => true,
                                               ],
                          'headers'         => [
                                                'User-Agent'      => $agent,
                                                'Accept'          => 'application/json',
                                                'Accept-Encoding' => 'deflate,sdch',
                                                'Accept-Charset'  => 'utf-8;q=1',
                                               ],
                         ];
        $result        = $client->request(
            'GET',
            $redireUrl,
            $redirectParam,
        );
        $retLog        = [
                          'status' => $result->getStatusCode(),//todo 后面需要处理错误码
                          'header' => $result->getHeader('content-type')[0],
                          'body'   => \GuzzleHttp\json_decode($result->getBody()->getContents(), true),
                         ];
        Log::channel('game')->info('返回数据', $retLog);
        $return = [];
        if (isset($retLog['body']['d']['url'])) {
            $return = $retLog['body']['d']['url'];
        }
        return $return;
    }
}
