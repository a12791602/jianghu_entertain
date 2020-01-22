<?php

namespace App\Http\Controllers\BackendApi\Headquarters;

use App\Http\Controllers\BackendApi\BackEndApiMainController;
use App\Http\Requests\Backend\Headquarters\Email\ReceivedIndexRequest;
use App\Http\Requests\Backend\Headquarters\Email\SendIndexRequest;
use App\Http\Requests\Backend\Headquarters\Email\SendRequest;
use App\Http\SingleActions\Backend\Headquarters\Email\ReceivedIndexAction;
use App\Http\SingleActions\Backend\Headquarters\Email\SendAction;
use App\Http\SingleActions\Backend\Headquarters\Email\SendIndexAction;
use Illuminate\Http\JsonResponse;

/**
 * 总控的邮件系统控制器
 * Class BackendSystemEmailController
 *
 * @package App\Http\Controllers\BackendApi\Headquarters
 */
class BackendSystemEmailController extends BackEndApiMainController
{
    /**
     * 发送邮件
     *
     * @param  SendAction  $action  Action.
     * @param  SendRequest $request Request.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function send(
        SendAction $action,
        SendRequest $request
    ): JsonResponse {
        $inputDatas = $request->validated();
        $msgOut     = $action->execute($this, $inputDatas);
        return $msgOut;
    }

    /**
     * 已发邮件.
     *
     * @param SendIndexAction  $action  Action.
     * @param SendIndexRequest $request Request.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function sendIndex(SendIndexAction $action, SendIndexRequest $request): JsonResponse
    {
        $inputDatas = $request->validated();
        $msgOut     = $action->execute($inputDatas);
        return $msgOut;
    }

    /**
     * 已收邮件.
     *
     * @param ReceivedIndexAction  $action  Action.
     * @param ReceivedIndexRequest $request Request.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function receivedIndex(ReceivedIndexAction $action, ReceivedIndexRequest $request): JsonResponse
    {
        $inputDatas  = $request->validated();
        $outputDatas = $action->execute($inputDatas);
        return $outputDatas;
    }
}
