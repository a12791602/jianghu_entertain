<?php

namespace App\Http\Controllers\BackendApi\Headquarters\Activity;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Headquarters\Activity\SystemDynActivity\IndexRequest;
use App\Http\Requests\Backend\Headquarters\Activity\SystemDynActivity\StatusRequest;
use App\Http\SingleActions\Backend\Headquarters\Activity\SystemDynActivity\IndexAction;
use App\Http\SingleActions\Backend\Headquarters\Activity\SystemDynActivity\StatusAction;
use Illuminate\Http\JsonResponse;

/**
 * 动态活动控制器
 * Class BackendSystemDynActivityController
 *
 * @package App\Http\Controllers\BackendApi\Headquarters\Activity
 */
class BackendSystemDynActivityController extends Controller
{
    /**
     * 动态活动列表
     *
     * @param  IndexAction  $action  Action.
     * @param  IndexRequest $request Request.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function index(
        IndexAction $action,
        IndexRequest $request
    ): JsonResponse {
        $inputDatas = $request->validated();
        return $action->execute($inputDatas);
    }

    /**
     * 改变动态活动的状态
     *
     * @param  StatusAction  $action  Action.
     * @param  StatusRequest $request Request.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function status(
        StatusAction $action,
        StatusRequest $request
    ): JsonResponse {
        $inputDatas = $request->validated();
        return $action->execute($inputDatas);
    }
}
