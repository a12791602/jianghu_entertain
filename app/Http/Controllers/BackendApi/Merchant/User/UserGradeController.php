<?php

namespace App\Http\Controllers\BackendApi\Merchant\User;

use App\Http\Requests\Backend\Merchant\User\UserGrade\DeleteRequest;
use App\Http\Requests\Backend\Merchant\User\UserGrade\DoAddRequest;
use App\Http\Requests\Backend\Merchant\User\UserGrade\EditRequest;
use App\Http\Requests\Backend\Merchant\User\UserGrade\GradeConfigRequest;
use App\Http\SingleActions\Backend\Merchant\User\UserGrade\DeleteAction;
use App\Http\SingleActions\Backend\Merchant\User\UserGrade\DoAddAction;
use App\Http\SingleActions\Backend\Merchant\User\UserGrade\EditAction;
use App\Http\SingleActions\Backend\Merchant\User\UserGrade\GradeConfigAction;
use App\Http\SingleActions\Backend\Merchant\User\UserGrade\IndexAction;
use Illuminate\Http\JsonResponse;

/**
 * 用户等级管理
 */
class UserGradeController
{

    /**
     * 用户等级-配置
     *
     * @param GradeConfigRequest $request Request.
     * @param GradeConfigAction  $action  Action.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function gradeConfig(
        GradeConfigRequest $request,
        GradeConfigAction $action
    ): JsonResponse {
        $inputDatas = $request->validated();
        $msgOut     = $action->execute($inputDatas);
        return $msgOut;
    }

    /**
     * 用户等级-列表
     *
     * @param IndexAction $action Action.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function index(IndexAction $action): JsonResponse
    {
        $msgOut = $action->execute();
        return $msgOut;
    }

    /**
     * 用户等级-添加
     *
     * @param DoAddRequest $request Request.
     * @param DoAddAction  $action  Action.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function doAdd(DoAddRequest $request, DoAddAction $action): JsonResponse
    {
        $inputDatas = $request->validated();
        $msgOut     = $action->execute($inputDatas);
        return $msgOut;
    }

    /**
     * 用户等级-编辑
     *
     * @param EditRequest $request Request.
     * @param EditAction  $action  Action.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function edit(EditRequest $request, EditAction $action): JsonResponse
    {
        $inputDatas = $request->validated();
        $msgOut     = $action->execute($inputDatas);
        return $msgOut;
    }

    /**
     * 用户等级-删除
     *
     * @param DeleteRequest $request Request.
     * @param DeleteAction  $action  Action.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function delete(DeleteRequest $request, DeleteAction $action): JsonResponse
    {
        $inputDatas = $request->validated();
        $msgOut     = $action->execute($inputDatas);
        return $msgOut;
    }
}
