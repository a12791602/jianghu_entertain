<?php

namespace App\Http\Controllers\BackendApi\Headquarters\DeveloperUsage\Backend;

use App\Http\Requests\Backend\Headquarters\DeveloperUsage\Backend\Route\DeleteRequest;
use App\Http\Requests\Backend\Headquarters\DeveloperUsage\Backend\Route\DoAddRequest;
use App\Http\Requests\Backend\Headquarters\DeveloperUsage\Backend\Route\EditRequest;
use App\Http\SingleActions\Backend\Headquarters\DeveloperUsage\Backend\Route\DeleteAction;
use App\Http\SingleActions\Backend\Headquarters\DeveloperUsage\Backend\Route\DoAddAction;
use App\Http\SingleActions\Backend\Headquarters\DeveloperUsage\Backend\Route\EditAction;
use App\Http\SingleActions\Backend\Headquarters\DeveloperUsage\Backend\Route\IndexAction;
use Illuminate\Http\JsonResponse;

/**
 * 路由
 */
class RouteController
{
    /**
     * 路由-列表
     * @param  IndexAction $action Action.
     * @return JsonResponse
     */
    public function index(IndexAction $action): JsonResponse
    {
        $msgOut = $action->execute();
        return $msgOut;
    }

    /**
     * 路由-添加
     * @param  DoAddRequest $request Request.
     * @param  DoAddAction  $action  Action.
     * @return JsonResponse
     */
    public function doAdd(DoAddRequest $request, DoAddAction $action): JsonResponse
    {
        $inputDatas = $request->validated();
        $msgOut     = $action->execute($inputDatas);
        return $msgOut;
    }

    /**
     * 路由-编辑
     * @param  EditRequest $request Request.
     * @param  EditAction  $action  Action.
     * @return JsonResponse
     */
    public function edit(EditRequest $request, EditAction $action): JsonResponse
    {
        $inputDatas = $request->validated();
        $msgOut     = $action->execute($inputDatas);
        return $msgOut;
    }

    /**
     * 路由-删除
     * @param  DeleteRequest $request Request.
     * @param  DeleteAction  $action  Action.
     * @return JsonResponse
     */
    public function delete(DeleteRequest $request, DeleteAction $action): JsonResponse
    {
        $inputDatas = $request->validated();
        $msgOut     = $action->execute($inputDatas);
        return $msgOut;
    }
}
