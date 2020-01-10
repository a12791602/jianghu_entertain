<?php

namespace App\Http\SingleActions\Backend\Merchant\Acknowledgement;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

/**
 * Class AckInAction
 * @package App\Http\SingleActions\Backend\Merchant\Acknowledgement
 */
class AckInAction
{
    /**
     * @param array $inputDatas 参数.
     * @param array $headers    请求头.
     * @return JsonResponse return.
     * @throws \Exception Exception.
     */
    public function execute(array $inputDatas = [], array $headers = []): JsonResponse
    {
        $inputToLog = json_encode($inputDatas, JSON_THROW_ON_ERROR | JSON_PRETTY_PRINT, 512);
        Log::channel('ack-center')->info('Inputs are ' . $inputToLog);
        $headersToLog = json_encode($headers, JSON_THROW_ON_ERROR | JSON_PRETTY_PRINT, 512);
        Log::channel('ack-center')->info('Headers are ' . $headersToLog);
        $return = msgOut(true);
        return $return;
    }
}
