<?php

namespace App\Lib;

use Illuminate\Support\Facades\Log;
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
    public $chatId;

    /**
     * TGMSG constructor.
     * @param string $chatId   TGMSG ChatGroupId.
     * @param string $botToken Telegram BotToken.
     * @throws \Telegram\Bot\Exceptions\TelegramSDKException TelegramSDKException.
     */
    public function __construct(
        string $chatId,
        string $botToken
    ) {
        $this->tgObj  = new Api($botToken);
        $this->chatId = $chatId;
    }

    /**
     * @param string $message 信息.
     * @return boolean
     */
    public function sendMessage(string $message = '江湖丁丁'): bool
    {
        $done                 = false;
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
        $returnMultiple  = [];
        for ($i = 1; $i <= $times; $i++) {
            $message          = mb_substr($fullmsg, $start, $sendAbleStringLength);
            $start           += $sendAbleStringLength;
            $returnMultiple[] = $this->_sendMessage($message);
        }
        if (!in_array(false, $returnMultiple, true)) {
            $done = true;
        }
        return $done;
    }

    /**
     * @param string $message 信息.
     * @return boolean
     */
    private function _sendMessage(string $message): bool
    {
        $params = [
                   'chat_id' => $this->chatId,
                   'text'    => $message,
                  ];
        if ($this->chatId === null) {
            return false;
        }
        try {
            $this->tgObj->sendMessage(
                $params,
            );
        } catch (\Throwable $e) {
            Log::channel('telegram')->error(
                $e->getMessage(),
                ['exception' => $e],
            );
            return false;
        }
        return true;
    }
}
