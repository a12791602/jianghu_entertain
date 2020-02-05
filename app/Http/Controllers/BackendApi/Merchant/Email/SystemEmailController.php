<?php

namespace App\Http\Controllers\BackendApi\Merchant\Email;

use App\Http\Requests\Backend\Merchant\Email\ReadEmailRequest;
use App\Http\Requests\Backend\Merchant\Email\ReceivedIndexRequest;
use App\Http\Requests\Backend\Merchant\Email\SendIndexRequest;
use App\Http\Requests\Backend\Merchant\Email\SendRequest;
use App\Http\SingleActions\Backend\Merchant\Email\ReadEmailAction;
use App\Http\SingleActions\Backend\Merchant\Email\ReceivedIndexAction;
use App\Http\SingleActions\Backend\Merchant\Email\SendAction;
use App\Http\SingleActions\Backend\Merchant\Email\SendIndexAction;
use Illuminate\Http\JsonResponse;

/**
 * Class SystemEmailController
 * @package App\Http\Controllers\BackendApi\Merchant\Email
 */
class SystemEmailController
{
    /**
     * 发送邮件.
     *
     * @param SendAction  $action  Action.
     * @param SendRequest $request Request.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function send(SendAction $action, SendRequest $request): JsonResponse
    {
        $inputDatas  = $request->validated();
        $outputDatas = $action->execute($inputDatas);
        return $outputDatas;
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
        $inputDatas  = $request->validated();
        $outputDatas = $action->execute($inputDatas);
        return $outputDatas;
    }

    /**
     * 已收邮件.
     *
     * @param ReceivedIndexAction  $action  Action.
     * @param ReceivedIndexRequest $request Request.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function receivedIndex(
        ReceivedIndexAction $action,
        ReceivedIndexRequest $request
    ): JsonResponse {
        $inputDatas  = $request->validated();
        $outputDatas = $action->execute($inputDatas);
        return $outputDatas;
    }

    /**
     * 读邮件.
     *
     * @param ReadEmailAction  $action  Action.
     * @param ReadEmailRequest $request Request.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function readEmail(ReadEmailAction $action, ReadEmailRequest $request): JsonResponse
    {
        $inputDatas  = $request->validated();
        $outputDatas = $action->execute($inputDatas);
        return $outputDatas;
    }
}
