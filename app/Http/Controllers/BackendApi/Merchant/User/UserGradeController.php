<?php

namespace App\Http\Controllers\BackendApi\Merchant\User;

use App\Http\Controllers\BackendApi\BackEndApiMainController;
use App\Http\Requests\Backend\Merchant\User\UserGrade\GradeConfigRequest;
use App\Http\SingleActions\Backend\Merchant\User\UserGrade\GradeConfigAction;
use Illuminate\Http\JsonResponse;

/**
 * 用户等级管理
 */
class UserGradeController extends BackEndApiMainController
{

    /**
     * 用户等级配置
     *
     * @param  GradeConfigRequest $request Request.
     * @param  GradeConfigAction  $action  Action.
     * @return JsonResponse
     */
    public function gradeConfig(
        GradeConfigRequest $request,
        GradeConfigAction $action
    ): JsonResponse {
        $inputDatas = $request->validated();
        $msgOut     = $action->execute($this, $inputDatas);
        return $msgOut;
    }
}
