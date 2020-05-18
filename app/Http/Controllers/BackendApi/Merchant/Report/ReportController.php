<?php

namespace App\Http\Controllers\BackendApi\Merchant\Report;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Merchant\Report\GameProjectRequest;
use App\Http\Requests\Backend\Merchant\Report\UserAuditRequest;
use App\Http\SingleActions\Backend\Merchant\Report\GameProjectAction;
use App\Http\SingleActions\Backend\Merchant\Report\UserAuditAction;
use Illuminate\Http\JsonResponse;

/**
 * 报表管理
 */
class ReportController extends Controller
{

    /**
     * 平台注单-列表
     *
     * @param  GameProjectRequest $request Request.
     * @param  GameProjectAction  $action  Action.
     * @return JsonResponse
     */
    public function gameProject(
        GameProjectRequest $request,
        GameProjectAction $action
    ): JsonResponse {
        $inputDatas = $request->validated();
        return $action->execute($inputDatas);
    }

    /**
     * 用户稽核-列表
     *
     * @param  UserAuditRequest $request Request.
     * @param  UserAuditAction  $action  Action.
     * @return JsonResponse
     */
    public function userAudit(
        UserAuditRequest $request,
        UserAuditAction $action
    ): JsonResponse {
        $inputDatas = $request->validated();
        return $action->execute($inputDatas);
    }
}
