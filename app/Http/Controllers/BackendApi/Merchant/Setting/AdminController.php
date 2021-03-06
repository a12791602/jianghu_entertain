<?php

namespace App\Http\Controllers\BackendApi\Merchant\Setting;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Merchant\Setting\Admin\CreateRequest;
use App\Http\Requests\Backend\Merchant\Setting\Admin\DeleteAdminRequest;
use App\Http\Requests\Backend\Merchant\Setting\Admin\DestroyRequest;
use App\Http\Requests\Backend\Merchant\Setting\Admin\EditRequest;
use App\Http\Requests\Backend\Merchant\Setting\Admin\GroupCreateRequest;
use App\Http\Requests\Backend\Merchant\Setting\Admin\SearchAdminRequest;
use App\Http\Requests\Backend\Merchant\Setting\Admin\SpecificGroupUsersRequest;
use App\Http\Requests\Backend\Merchant\Setting\Admin\SwitchAdminRequest;
use App\Http\Requests\Backend\Merchant\Setting\Admin\UpdateAdminGroupRequest;
use App\Http\Requests\Backend\Merchant\Setting\Admin\UpdatePasswordRequest;
use App\Http\SingleActions\Backend\Merchant\Setting\Admin\AllAdminsAction;
use App\Http\SingleActions\Backend\Merchant\Setting\Admin\CreateAction;
use App\Http\SingleActions\Backend\Merchant\Setting\Admin\DeleteAdminAction;
use App\Http\SingleActions\Backend\Merchant\Setting\Admin\DestroyAction;
use App\Http\SingleActions\Backend\Merchant\Setting\Admin\EditAction;
use App\Http\SingleActions\Backend\Merchant\Setting\Admin\GroupCreateAction;
use App\Http\SingleActions\Backend\Merchant\Setting\Admin\GroupIndexAction;
use App\Http\SingleActions\Backend\Merchant\Setting\Admin\SearchAdminAction;
use App\Http\SingleActions\Backend\Merchant\Setting\Admin\SpecificGroupUsersAction;
use App\Http\SingleActions\Backend\Merchant\Setting\Admin\SwitchAdminAction;
use App\Http\SingleActions\Backend\Merchant\Setting\Admin\UpdateAdminGroupAction;
use App\Http\SingleActions\Backend\Merchant\Setting\Admin\UpdatePasswordAction;
use Illuminate\Http\JsonResponse;

/**
 * Controls the data flow into a merchant admin user object and updates the view whenever data changes.
 */
class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param GroupIndexAction $action Action.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function groupIndex(
        GroupIndexAction $action
    ): JsonResponse {
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
     * ????????????????????????
     *
     * @param  DestroyRequest $request Request.
     * @param  DestroyAction  $action  Action.
     * @return JsonResponse
     */
    public function destroy(
        DestroyRequest $request,
        DestroyAction $action
    ): JsonResponse {
        $inputDatas = $request->validated();
        return $action->execute($inputDatas);
    }

    /**
     * ?????????????????????
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
     * create api
     *
     * @param  CreateRequest $request Request.
     * @param  CreateAction  $action  Action.
     * @return JsonResponse
     */
    public function create(CreateRequest $request, CreateAction $action): JsonResponse
    {
        $inputDatas = $request->validated();
        return $action->execute($inputDatas);
    }

    /**
     * ????????????????????????????????????????????????
     *
     * @param  AllAdminsAction $action Action.
     * @return JsonResponse
     */
    public function allAdmins(AllAdminsAction $action): JsonResponse
    {
        return $action->execute();
    }

    /**
     * ???????????????????????????
     *
     * @param  UpdateAdminGroupRequest $request Request.
     * @param  UpdateAdminGroupAction  $action  Action.
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
     * ???????????????
     *
     * @param  DeleteAdminRequest $request Request.
     * @param  DeleteAdminAction  $action  Action.
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
     * @param  SearchAdminRequest $request Request.
     * @param  SearchAdminAction  $action  Action.
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
     * ?????????????????????
     * @param  SwitchAdminRequest $request ???????????????.
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

    /**
     * ?????????????????????
     * @param UpdatePasswordRequest $request ???????????????.
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
}
