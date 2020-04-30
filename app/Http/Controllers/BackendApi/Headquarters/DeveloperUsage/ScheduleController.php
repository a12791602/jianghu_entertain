<?php

namespace App\Http\Controllers\BackendApi\Headquarters\DeveloperUsage;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Headquarters\DeveloperUsage\Schedule\DeleteRequest;
use App\Http\Requests\Backend\Headquarters\DeveloperUsage\Schedule\DoAddRequest;
use App\Http\Requests\Backend\Headquarters\DeveloperUsage\Schedule\EditRequest;
use App\Http\Requests\Backend\Headquarters\DeveloperUsage\Schedule\IndexRequest;
use App\Http\SingleActions\Backend\Headquarters\DeveloperUsage\Schedule\DeleteAction;
use App\Http\SingleActions\Backend\Headquarters\DeveloperUsage\Schedule\DoAddAction;
use App\Http\SingleActions\Backend\Headquarters\DeveloperUsage\Schedule\EditAction;
use App\Http\SingleActions\Backend\Headquarters\DeveloperUsage\Schedule\IndexAction;
use Illuminate\Http\JsonResponse;

/**
 * 定时任务
 * Class ScheduleController
 *
 * @package App\Http\Controllers\BackendApi\Headquarters\DeveloperUsage
 */
class ScheduleController extends Controller
{
    /**
     * 定时任务-列表
     * @param  IndexAction  $action  Action.
     * @param  IndexRequest $request Request.
     * @return JsonResponse
     */
    public function index(
        IndexAction $action,
        IndexRequest $request
    ): JsonResponse {
        $inputDatas = $request->validated();
        return $action->execute($inputDatas);
    }

    /**
     * 定时任务-添加
     * @param  DoAddAction  $action  Action.
     * @param  DoAddRequest $request Request.
     * @return JsonResponse
     */
    public function doAdd(
        DoAddAction $action,
        DoAddRequest $request
    ): JsonResponse {
        $inputDatas = $request->validated();
        return $action->execute($inputDatas);
    }

    /**
     * 定时任务-编辑
     * @param  EditAction  $action  Action.
     * @param  EditRequest $request Request.
     * @return JsonResponse
     */
    public function edit(
        EditAction $action,
        EditRequest $request
    ): JsonResponse {
        $inputDatas = $request->validated();
        return $action->execute($inputDatas);
    }

    /**
     * 定时任务-删除
     * @param  DeleteAction  $action  Action.
     * @param  DeleteRequest $request Request.
     * @return JsonResponse
     */
    public function delete(
        DeleteAction $action,
        DeleteRequest $request
    ): JsonResponse {
        $inputDatas = $request->validated();
        return $action->execute($inputDatas);
    }
}
