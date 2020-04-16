<?php

namespace App\Http\Controllers\BackendApi\Merchant\Setting;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Merchant\Setting\OperationLog\IndexRequest;
use App\Http\SingleActions\Backend\Merchant\Setting\OperationLog\IndexAction;
use Illuminate\Http\JsonResponse;

/**
 * 操作日志
 */
class OperationLogController extends Controller
{
    /**
     * 操作日志-列表
     *
     * @param  IndexRequest $request Request.
     * @param  IndexAction  $action  Action.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function index(IndexRequest $request, IndexAction $action): JsonResponse
    {
        $inputDatas = $request->validated();
        return $action->execute($inputDatas);
    }
}
