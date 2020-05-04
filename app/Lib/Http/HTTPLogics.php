<?php

namespace App\Game\GameModule\IM\Logics;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

trait HTTPLogics
{

    /**
     * @var array
     */
    protected $requestParam;

    /**
     * @var string
     */
    protected $requestUrl;

    /**
     * @var string
     */
    protected $errorCodePrefix;

    /**
     * @var array
     */
    protected $successStatus;

    /**
     * @var \Illuminate\Http\Client\Response
     */
    protected $response;

    /**
     * @var string
     */
    protected $responseStatusIndex;

    /**
     * @var string
     */
    protected $logTitle = '';

    /**
     * @var string
     */
    protected $logChannel = 'daily';

    /**
     * @var boolean
     */
    protected $executeDirectResult = false;

    /**
     * @param Response $response Response of Url.
     * @return void
     */
    protected function rspLog(Response $response): void
    {
        $retLog = [
                   'ok'          => $response->ok(),
                   'successful'  => $response->successful(),
                   'status'      => $response->status(),
                   'headers'     => $response->headers(),
                   'body'        => $response->body(),
                   'JsonBody'    => $response->json(),
                   'serverError' => $response->serverError(),
                   'clientError' => $response->clientError(),
                  ];
        Log::channel('game')->info('返回数据', $retLog);
    }

    /**
     * 请求 游戏 HTTP 操作
     *
     * @param string $method Post|Get.
     * @return void
     * @throws \RuntimeException Exception.
     */
    protected function callRequest(string $method): void
    {
        $method  = strtolower($method);
        $logInfo = [
                    'vendor' => $this->gameVendor->name,
                    'params' => $this->requestParam,
                    'url'    => $this->requestUrl,
                   ];
        Log::channel($this->logChannel)->info('准备参数-' . $this->logTitle, $logInfo);
        $this->response = Http::retry(3, 100)->$method($this->requestUrl, $this->requestParam);
        $this->rspLog($this->response);
        if (!$this->response->ok()) {
            throw new \RuntimeException($this->errorCodePrefix . '-OW000');//IM请求失败
        }
        //Return an error message
        $resultString = $this->response->body();
        Log::channel($this->logChannel)->info('请求' . $this->logTitle . '返回数据为' . $resultString);
        if (!$this->executeDirectResult) {
            return;
        }
        $resultArr    = json_decode($resultString, true);
        $resultStatus = $resultArr[$this->responseStatusIndex];
        if (!in_array($resultStatus, $this->successStatus, true)) {
            throw new \RuntimeException($this->errorCodePrefix . '-' . $resultStatus);//VG请求失败
        }
    }
}
