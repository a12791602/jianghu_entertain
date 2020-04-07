<?php

namespace App\Http\Controllers\BackendApi\Headquarters\DeveloperUsage\Merchant;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Headquarters\DeveloperUsage\Merchant\Route\DeleteRequest;
use App\Http\Requests\Backend\Headquarters\DeveloperUsage\Merchant\Route\DoAddRequest;
use App\Http\Requests\Backend\Headquarters\DeveloperUsage\Merchant\Route\EditRequest;
use App\Http\Requests\Backend\Headquarters\DeveloperUsage\Merchant\Route\IsOpenRequest;
use App\Http\SingleActions\Backend\Headquarters\DeveloperUsage\Merchant\Route\DeleteAction;
use App\Http\SingleActions\Backend\Headquarters\DeveloperUsage\Merchant\Route\DoAddAction;
use App\Http\SingleActions\Backend\Headquarters\DeveloperUsage\Merchant\Route\EditAction;
use App\Http\SingleActions\Backend\Headquarters\DeveloperUsage\Merchant\Route\IndexAction;
use App\Http\SingleActions\Backend\Headquarters\DeveloperUsage\Merchant\Route\IsOpenAction;
use Illuminate\Http\JsonResponse;

/**
 * 路由
 */
class RouteController extends Controller
{
    /**
     * 路由-列表
     * @param  IndexAction $action Action.
     * @return JsonResponse
     */
    public function index(IndexAction $action): JsonResponse
    {
        return $action->execute();
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
        return $action->execute($inputDatas);
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
        return $action->execute($inputDatas);
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
        return $action->execute($inputDatas);
    }

    /**
     * 路由-是否开放
     * @param  IsOpenRequest $request Request.
     * @param  IsOpenAction  $action  Action.
     * @return JsonResponse
     */
    public function isOpen(IsOpenRequest $request, IsOpenAction $action): JsonResponse
    {
        $inputDatas = $request->validated();
        return $action->execute($inputDatas);
    }
}
