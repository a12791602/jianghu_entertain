<?php

namespace App\Game\GameModule\VR;

use App\Game\BaseGame;
use App\Http\SingleActions\MainAction;
use App\Models\Game\Game;
use App\Models\User\FrontendUser;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Class KyGame
 * @package App\Game\Ky
 */
class VRGame extends BaseGame
{

    /**
     * @var string
     */
    private $version = '1.0';

    /**
     * @var string
     */
    private $apiUrl = 'http://fe.vrbetdemo.com';

    /**
     * 进入游戏.
     * @param Game       $gameObj   GameObj.
     * @param MainAction $systemObj SysObj.
     * @return string[]
     * @throws \Exception Exception.
     */
    public function game(Game $gameObj, MainAction $systemObj): array
    {
        $this->gameItem       = $gameObj;
        $this->sysObj         = $systemObj;
        $gameUser             = $this->sysObj->getUser();
        $gameUserSpecificInfo = $gameUser->specificInfo;
        $createdUserArray     = $gameUserSpecificInfo->g_active;
        $createdUserStatus    = $createdUserArray[$this->gameVendor->sign];//0 new user,1 created user
        if ($createdUserStatus === 0) {
            $this->_createUser($gameUser);
            $createdUserArray[$this->gameVendor->sign] = 1;
            $gameUserSpecificInfo->g_active            = $createdUserArray;
            $gameUserSpecificInfo->save();
        }
        $redirectUrl = $this->_login($gameUser);
        $data        = ['url' => $redirectUrl];
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
     * 创建用户有些三方需要此操作 没有需要此操作返回 true
     * @return boolean
     */
    public function createAccount(): bool
    {
        return true;
    }

    /**
     * @param FrontendUser $gameUser FrontendUser.
     * @return string
     */
    private function _login(FrontendUser $gameUser): string
    {
        $channelId   = $this->gameItem->sign;
        $currentTime = now();
        $loginTime   = $currentTime->utc()
            ->format('Y-m-d\TH:i:s\Z');//2020-03-13T05:23:59Z 1584077039
        $dataString  = 'playerName=' . $gameUser->guid . '&loginTime=' . $loginTime;
        if ($channelId !== null) {
            $dataString .= '&channelId=' . $channelId;
        }
        //            if($playerOdds!== null){
        //                $data .= "&playerOdds=".$playerOdds;
        //            }
        $encrypt_data = $this->_encodeData($dataString);
        $loginUrl     = $this->apiUrl . '/Account/LoginValidate';
        $fData        = [
                         'version' => $this->version,
                         'id'      => $this->gameVendor->merchant_id,
                         'data'    => $encrypt_data,
                        ];
        $dataString   = http_build_query($fData);
        $urlWithData  = $loginUrl . '?' . $dataString;
        return $urlWithData;
    }


    /**
     * @param string $data DataString.
     * @return string
     */
    private function _encodeData(string $data): string
    {
        $iv       = '';
        $encData  = openssl_encrypt($data, 'AES-256-ECB', $this->gameVendor->merchant_secret, OPENSSL_RAW_DATA, $iv);
        $b64edata = base64_encode((string) $encData);
        return $b64edata;
    }

    /**
     * @param string $base64_data DataString from Server Side.
     * @return string
     */
    private function _decodeData(string $base64_data): string
    {
        $iv         = '';
        $data       = base64_decode($base64_data);
        $plain_data = (string) openssl_decrypt(
            $data,
            'AES-256-ECB',
            $this->gameVendor->merchant_secret,
            OPENSSL_RAW_DATA,
            $iv,
        );
        return $plain_data;
    }

    //新增玩家帳戶


    /**
     * @param FrontendUser $gameUser FrontendUser.
     * @return boolean
     * @throws \RuntimeException Exception.
     */
    private function _createUser(FrontendUser $gameUser): bool
    {
        $data     = ['playerName' => $gameUser->guid];
        $dataJson = json_encode($data);
        if ($dataJson === false) {
            throw new \RuntimeException('VG-01');//VG请求失败
        }
        $encrypt_data = $this->_encodeData($dataJson);
        $redireUrl    = $this->apiUrl . '/Account/CreateUser';
        $param        = [
                         'version' => $this->version,
                         'id'      => $this->gameVendor->merchant_id,
                         'data'    => $encrypt_data,
                        ];
        $logInfo      = [
                         'games'  => $this->gameVendor->name . '=>' . $this->gameItem->name,
                         'params' => $param,
                         'url'    => $redireUrl,
                        ];
        Log::channel('game')->info('准备参数', $logInfo);
        $response = Http::retry(3, 100)->post($redireUrl, $param);
        $this->rspLog($response);
        if (!$response->ok()) {
            throw new \RuntimeException('VG-00');//VG请求失败
        }

        //Return an error message
        $resultString = $this->_decodeData($response->body());
        Log::channel('game')->info('解密后的数据为' . $resultString);
        $resultArr     = json_decode($resultString, true);
        $resultStatus  = $resultArr['errorCode'];
        $successStatus = [
                          0,
                          18,
                         ];
        if (!in_array($resultStatus, $successStatus, true)) {
            throw new \RuntimeException('VG-' . $resultStatus);//VG请求失败
        }
        $result = true;
        return $result;
    }
}
