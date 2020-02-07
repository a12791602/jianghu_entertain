<?php

namespace App\Http\Controllers\BackendApi\Headquarters\Setting;

use App\Http\Requests\Backend\Headquarters\Setting\LoginLog\IndexRequest;
use App\Http\SingleActions\Backend\Headquarters\Setting\LoginLog\IndexAction;
use Illuminate\Http\JsonResponse;

/**
 * 登录日志
 */
class LoginLogController
{
    /**
     * 登录日志-列表
     *
     * @param  IndexRequest $request Request.
     * @param  IndexAction  $action  Action.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function index(IndexRequest $request, IndexAction $action): JsonResponse
    {
        $inputDatas = $request->validated();
        $msgOut     = $action->execute($inputDatas);
        return $msgOut;
    }
}
