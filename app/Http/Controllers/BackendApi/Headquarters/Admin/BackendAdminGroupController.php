<?php

namespace App\Http\Controllers\BackendApi\Headquarters\Admin;

use App\Http\Controllers\BackendApi\BackEndApiMainController;
use App\Http\Requests\Backend\Headquarters\Admin\BackendAdminGroup\CreateRequest;
use App\Http\Requests\Backend\Headquarters\Admin\BackendAdminGroup\DestroyRequest;
use App\Http\Requests\Backend\Headquarters\Admin\BackendAdminGroup\EditRequest;
use App\Http\Requests\Backend\Headquarters\Admin\BackendAdminGroup\SpecificGroupUsersRequest;
use App\Http\SingleActions\Backend\Headquarters\Admin\BackendAdminGroup\CreateAction;
use App\Http\SingleActions\Backend\Headquarters\Admin\BackendAdminGroup\DestroyAction;
use App\Http\SingleActions\Backend\Headquarters\Admin\BackendAdminGroup\EditAction;
use App\Http\SingleActions\Backend\Headquarters\Admin\BackendAdminGroup\IndexAction;
use App\Http\SingleActions\Backend\Headquarters\Admin\BackendAdminGroup\SpecificGroupUsersAction;
use Illuminate\Http\JsonResponse;

/**
 * 管理员角色组
 */
class BackendAdminGroupController extends BackEndApiMainController
{
    /**
     * Display a listing of the resource.
     *
     * @param  IndexAction $action Action.
     * @return JsonResponse
     */
    public function index(IndexAction $action): JsonResponse
    {
        $msgOut = $action->execute();
        return $msgOut;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  CreateRequest $request Request.
     * @param  CreateAction  $action  Action.
     * @return JsonResponse
     */
    public function create(CreateRequest $request, CreateAction $action): JsonResponse
    {
        $inputDatas = $request->validated();
        $msgOut     = $action->execute($this, $inputDatas);
        return $msgOut;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  EditRequest $request Request.
     * @param  EditAction  $action  Action.
     * @return JsonResponse
     */
    public function edit(EditRequest $request, EditAction $action): JsonResponse
    {
        $inputDatas = $request->validated();
        $msgOut     = $action->execute($this, $inputDatas);
        return $msgOut;
    }

    /**
     * 删除组管理员角色
     *
     * @param  DestroyRequest $request Request.
     * @param  DestroyAction  $action  Action.
     * @return JsonResponse
     */
    public function destroy(DestroyRequest $request, DestroyAction $action): JsonResponse
    {
        $inputDatas = $request->validated();
        $msgOut     = $action->execute($inputDatas);
        return $msgOut;
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
        $msgOut     = $action->execute($inputDatas);
        return $msgOut;
    }
}
