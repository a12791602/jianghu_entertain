<?php

namespace App\Http\Controllers\BackendApi\Merchant\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Merchant\User\UsersTag\DeleteRequest;
use App\Http\Requests\Backend\Merchant\User\UsersTag\DoAddRequest;
use App\Http\Requests\Backend\Merchant\User\UsersTag\EditRequest;
use App\Http\SingleActions\Backend\Merchant\User\UsersTag\DeleteAction;
use App\Http\SingleActions\Backend\Merchant\User\UsersTag\DoAddAction;
use App\Http\SingleActions\Backend\Merchant\User\UsersTag\EditAction;
use App\Http\SingleActions\Backend\Merchant\User\UsersTag\IndexAction;
use Illuminate\Http\JsonResponse;

/**
 * 用户标签管理
 */
class UsersTagController extends Controller
{

    /**
     * 用户标签-列表
     *
     * @param IndexAction $action Action.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function index(IndexAction $action): JsonResponse
    {
        return $action->execute();
    }

    /**
     * 用户标签-添加
     *
     * @param  DoAddRequest $request Request.
     * @param  DoAddAction  $action  Action.
     * @return JsonResponse
     */
    public function doAdd(
        DoAddRequest $request,
        DoAddAction $action
    ): JsonResponse {
        $inputDatas = $request->validated();
        return $action->execute($inputDatas);
    }

    /**
     * 用户标签-编辑
     *
     * @param  EditRequest $request Request.
     * @param  EditAction  $action  Action.
     * @return JsonResponse
     */
    public function edit(
        EditRequest $request,
        EditAction $action
    ): JsonResponse {
        $inputDatas = $request->validated();
        return $action->execute($inputDatas);
    }

    /**
     * 用户标签-删除
     * @param  DeleteRequest $request Request.
     * @param  DeleteAction  $action  Action.
     * @return JsonResponse
     */
    public function delete(
        DeleteRequest $request,
        DeleteAction $action
    ): JsonResponse {
        $inputDatas = $request->validated();
        return $action->execute($inputDatas);
    }
}
