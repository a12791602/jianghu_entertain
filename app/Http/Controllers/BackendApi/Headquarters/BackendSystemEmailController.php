<?php

namespace App\Http\Controllers\BackendApi\Headquarters;

use App\Http\Controllers\BackendApi\BackEndApiMainController;
use App\Http\Requests\Backend\Headquarters\Email\SendRequest;
use App\Http\SingleActions\Backend\Headquarters\Email\SendAction;
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
}
