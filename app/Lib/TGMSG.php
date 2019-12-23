<?php

namespace App\Lib;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Telegram\Bot\Api;

/**
 * Class TGMSG
 * @package App\Lib
 */
class TGMSG
{

    /**
     * @var Api
     */
    private $tgObj;

    /**
     * @var string
     */
    private $chatId;

    /**
     * TGMSG constructor.
     */
    public function __construct()
    {
        $this->tgObj  = new Api('823054027:AAEY_Qcws74hMQpktd7GAsSWhO8RHN1-4UM');
        $environment  = App::environment();
        $currentRoute = Route::getCurrentRoute();
        $prefixs      = empty($currentRoute) ? null : trim($currentRoute->getPrefix(), '/');
        $prefixArr    = explode('/', $prefixs);
        $prefix       = !empty($prefixArr[0]) ? $prefixArr[0] : 'other';
        $this->chatId = Config::get('telegram.chats.' . $environment . '.' . $prefix);
    }

    /**
     * @param string $message 信息.
     * @return \Telegram\Bot\Objects\Message|boolean
     */
    public function sendMessage(string $message = '江湖丁丁')
    {
        $preMsg               = "######################[开始]######################\n";
        $tailMsg              = "######################[结束]######################\n";
        $fullmsg              = $preMsg . $message . $tailMsg;
        $stringLenUtf8        = mb_strlen($fullmsg, 'UTF-8');
        $sendAbleStringLength = 4096;
        if ($stringLenUtf8 <= $sendAbleStringLength) {
            $return = $this->_sendMessage($fullmsg);
            return $return;
        }
        $modulus         = $stringLenUtf8 % $sendAbleStringLength;
        $additionalTimes = $modulus > 0 ? 1 : 0;
        $times           = (int) floor($stringLenUtf8 / $sendAbleStringLength) + $additionalTimes;
        $start           = 0;
        for ($i = 1; $i <= $times; $i++) {
            $message = mb_substr($fullmsg, $start, $sendAbleStringLength);
            $start  += $sendAbleStringLength;
            $this->_sendMessage($message);
        }
    }

    /**
     * @param string $message 信息.
     * @return boolean|\Telegram\Bot\Objects\Message
     */
    private function _sendMessage(string $message)
    {
        $params = [
            'chat_id' => $this->chatId,
            'text' => $message,
        ];
        if ($this->chatId === null) {
            return false;
        }
        try {
            $response = $this->tgObj->sendMessage(
                $params,
            );
            return $response;
        } catch (\Throwable $e) {
            Log::channel('telegram')->error(
                $e->getMessage(),
                ['exception' => $e],
            );
            return false;
        }
    }
}
