<?php

namespace App\Http\Controllers\BackendApi\Headquarters\Setting;

use App\Http\Requests\Backend\Headquarters\Setting\Admin\CreateRequest;
use App\Http\Requests\Backend\Headquarters\Setting\Admin\DeleteAdminRequest;
use App\Http\Requests\Backend\Headquarters\Setting\Admin\GroupCreateRequest;
use App\Http\Requests\Backend\Headquarters\Setting\Admin\GroupDestroyRequest;
use App\Http\Requests\Backend\Headquarters\Setting\Admin\GroupEditRequest;
use App\Http\Requests\Backend\Headquarters\Setting\Admin\SearchAdminRequest;
use App\Http\Requests\Backend\Headquarters\Setting\Admin\SelfUpdatePasswordRequest;
use App\Http\Requests\Backend\Headquarters\Setting\Admin\SpecificGroupUsersRequest;
use App\Http\Requests\Backend\Headquarters\Setting\Admin\SwitchAdminRequest;
use App\Http\Requests\Backend\Headquarters\Setting\Admin\UpdateAdminGroupRequest;
use App\Http\Requests\Backend\Headquarters\Setting\Admin\UpdatePasswordRequest;
use App\Http\SingleActions\Backend\Headquarters\Setting\Admin\CreateAction;
use App\Http\SingleActions\Backend\Headquarters\Setting\Admin\DeleteAdminAction;
use App\Http\SingleActions\Backend\Headquarters\Setting\Admin\GroupCreateAction;
use App\Http\SingleActions\Backend\Headquarters\Setting\Admin\GroupDestroyAction;
use App\Http\SingleActions\Backend\Headquarters\Setting\Admin\GroupEditAction;
use App\Http\SingleActions\Backend\Headquarters\Setting\Admin\GroupListAction;
use App\Http\SingleActions\Backend\Headquarters\Setting\Admin\SearchAdminAction;
use App\Http\SingleActions\Backend\Headquarters\Setting\Admin\SelfUpdatePasswordAction;
use App\Http\SingleActions\Backend\Headquarters\Setting\Admin\SpecificGroupUsersAction;
use App\Http\SingleActions\Backend\Headquarters\Setting\Admin\SwitchAdminAction;
use App\Http\SingleActions\Backend\Headquarters\Setting\Admin\UpdateAdminGroupAction;
use App\Http\SingleActions\Backend\Headquarters\Setting\Admin\UpdatePasswordAction;
use Illuminate\Http\JsonResponse;

/**
 * 管理员
 */
class AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @param  GroupListAction $action Action.
     * @return JsonResponse
     */
    public function groupList(GroupListAction $action): JsonResponse
    {
        return $action->execute();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  GroupCreateRequest $request Request.
     * @param  GroupCreateAction  $action  Action.
     * @return JsonResponse
     */
    public function groupCreate(
        GroupCreateRequest $request,
        GroupCreateAction $action
    ): JsonResponse {
        $inputDatas = $request->validated();
        return $action->execute($inputDatas);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  GroupEditRequest $request Request.
     * @param  GroupEditAction  $action  Action.
     * @return JsonResponse
     */
    public function groupEdit(
        GroupEditRequest $request,
        GroupEditAction $action
    ): JsonResponse {
        $inputDatas = $request->validated();
        return $action->execute($inputDatas);
    }

    /**
     * 删除组管理员角色
     *
     * @param  GroupDestroyRequest $request Request.
     * @param  GroupDestroyAction  $action  Action.
     * @return JsonResponse
     */
    public function groupDestroy(
        GroupDestroyRequest $request,
        GroupDestroyAction $action
    ): JsonResponse {
        $inputDatas = $request->validated();
        return $action->execute($inputDatas);
    }

    /**
     * 获取管理员角色
     *
     * @param  SpecificGroupUsersRequest $request Request.
     * @param  SpecificGroupUsersAction  $action  Action.
     * @return JsonResponse
     */
    public function specificGroupUsers(
        SpecificGroupUsersRequest $request,
        SpecificGroupUsersAction $action
    ): JsonResponse {
        $inputDatas = $request->validated();
        return $action->execute($inputDatas);
    }

    /**
     * 生成管理员
     * @param CreateRequest $request 接收的参数.
     * @param CreateAction  $action  Action.
     * @return JsonResponse
     */
    public function create(CreateRequest $request, CreateAction $action): JsonResponse
    {
        $inputDatas = $request->validated();
        return $action->execute($inputDatas);
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
        return $action->execute($inputDatas);
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
        return $action->execute($inputDatas);
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
        return $action->execute($inputDatas);
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
        return $action->execute($inputDatas);
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
        return $action->execute($inputDatas);
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
        return $action->execute($inputDatas);
    }
}
