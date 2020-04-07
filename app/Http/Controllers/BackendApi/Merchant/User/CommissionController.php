<?php

namespace App\Http\Controllers\BackendApi\Merchant\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Merchant\User\Commission\DeleteRequest;
use App\Http\Requests\Backend\Merchant\User\Commission\DoAddRequest;
use App\Http\Requests\Backend\Merchant\User\Commission\EditRequest;
use App\Http\Requests\Backend\Merchant\User\Commission\IndexRequest;
use App\Http\SingleActions\Backend\Merchant\User\Commission\DeleteAction;
use App\Http\SingleActions\Backend\Merchant\User\Commission\DoAddAction;
use App\Http\SingleActions\Backend\Merchant\User\Commission\EditAction;
use App\Http\SingleActions\Backend\Merchant\User\Commission\IndexAction;
use Illuminate\Http\JsonResponse;

/**
 * 洗码设置
 */
class CommissionController extends Controller
{

    /**
     * 洗码设置-列表
     *
     * @param  IndexRequest $request Request.
     * @param  IndexAction  $action  Action.
     * @return JsonResponse
     */
    public function index(IndexRequest $request, IndexAction $action): JsonResponse
    {
        $inputDatas = $request->validated();
        return $action->execute($inputDatas);
    }

    /**
     * 洗码设置-添加
     *
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
     * 洗码设置-编辑
     *
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
     * 洗码设置-删除
     *
     * @param  DeleteRequest $request Request.
     * @param  DeleteAction  $action  Action.
     * @return JsonResponse
     */
    public function delete(DeleteRequest $request, DeleteAction $action): JsonResponse
    {
        $inputDatas = $request->validated();
        return $action->execute($inputDatas);
    }
}
