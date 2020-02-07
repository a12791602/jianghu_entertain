<?php

namespace App\Http\Controllers\BackendApi\Headquarters\Admin;

use App\Http\Requests\Backend\Headquarters\Admin\BackendAdminUser\CreateRequest;
use App\Http\Requests\Backend\Headquarters\Admin\BackendAdminUser\DeleteAdminRequest;
use App\Http\Requests\Backend\Headquarters\Admin\BackendAdminUser\SearchAdminRequest;
use App\Http\Requests\Backend\Headquarters\Admin\BackendAdminUser\SelfUpdatePasswordRequest;
use App\Http\Requests\Backend\Headquarters\Admin\BackendAdminUser\SwitchAdminRequest;
use App\Http\Requests\Backend\Headquarters\Admin\BackendAdminUser\UpdateAdminGroupRequest;
use App\Http\Requests\Backend\Headquarters\Admin\BackendAdminUser\UpdatePasswordRequest;
use App\Http\SingleActions\Backend\Headquarters\Admin\BackendAdminUser\CreateAction;
use App\Http\SingleActions\Backend\Headquarters\Admin\BackendAdminUser\DeleteAdminAction;
use App\Http\SingleActions\Backend\Headquarters\Admin\BackendAdminUser\SearchAdminAction;
use App\Http\SingleActions\Backend\Headquarters\Admin\BackendAdminUser\SelfUpdatePasswordAction;
use App\Http\SingleActions\Backend\Headquarters\Admin\BackendAdminUser\SwitchAdminAction;
use App\Http\SingleActions\Backend\Headquarters\Admin\BackendAdminUser\UpdateAdminGroupAction;
use App\Http\SingleActions\Backend\Headquarters\Admin\BackendAdminUser\UpdatePasswordAction;
use Illuminate\Http\JsonResponse;

/**
 * 管理员
 */
class BackendAdminUserController
{
    /**
     * 生成管理员
     * @param CreateRequest $request 接收的参数.
     * @param CreateAction  $action  Action.
     * @return JsonResponse
     */
    public function create(CreateRequest $request, CreateAction $action): JsonResponse
    {
        $inputDatas = $request->validated();
        $msgOut     = $action->execute($inputDatas);
        return $msgOut;
    }

    /**
     * 修改管理员的归属组
     * @param UpdateAdminGroupRequest $request 接收的参数.
     * @param UpdateAdminGroupAction  $action  Action.
     * @return JsonResponse
     */
    public function updateAdminGroup(
        UpdateAdminGroupRequest $request,
        UpdateAdminGroupAction $action
    ): JsonResponse {
        $inputDatas = $request->validated();
        $msgOut     = $action->execute($inputDatas);
        return $msgOut;
    }

    /**
     * 删除管理员
     * @param DeleteAdminRequest $request 接收的参数.
     * @param DeleteAdminAction  $action  Action.
     * @return JsonResponse
     */
    public function deleteAdmin(
        DeleteAdminRequest $request,
        DeleteAdminAction $action
    ): JsonResponse {
        $inputDatas = $request->validated();
        $msgOut     = $action->execute($inputDatas);
        return $msgOut;
    }

    /**
     * 修改管理员密码
     * @param UpdatePasswordRequest $request 接收的参数.
     * @param UpdatePasswordAction  $action  Action.
     * @return JsonResponse
     */
    public function updatePassword(
        UpdatePasswordRequest $request,
        UpdatePasswordAction $action
    ): JsonResponse {
        $inputDatas = $request->validated();
        $msgOut     = $action->execute($inputDatas);
        return $msgOut;
    }

    /**
     * 管理员自己修改密码
     * @param SelfUpdatePasswordRequest $request 接收的参数.
     * @param SelfUpdatePasswordAction  $action  Action.
     * @return JsonResponse
     */
    public function selfUpdatePassword(
        SelfUpdatePasswordRequest $request,
        SelfUpdatePasswordAction $action
    ): JsonResponse {
        $inputDatas = $request->validated();
        $msgOut     = $action->execute($inputDatas);
        return $msgOut;
    }

    /**
     * 模糊查询管理员
     * @param SearchAdminRequest $request 接收的参数.
     * @param SearchAdminAction  $action  Action.
     * @return JsonResponse
     */
    public function searchAdmin(
        SearchAdminRequest $request,
        SearchAdminAction $action
    ): JsonResponse {
        $inputDatas = $request->validated();
        $msgOut     = $action->execute($inputDatas);
        return $msgOut;
    }

    /**
     * 修改管理员状态
     * @param  SwitchAdminRequest $request 接收的参数.
     * @param  SwitchAdminAction  $action  Action.
     * @return JsonResponse
     */
    public function switchAdmin(
        SwitchAdminRequest $request,
        SwitchAdminAction $action
    ): JsonResponse {
        $inputDatas = $request->validated();
        $msgOut     = $action->execute($inputDatas);
        return $msgOut;
    }
}
