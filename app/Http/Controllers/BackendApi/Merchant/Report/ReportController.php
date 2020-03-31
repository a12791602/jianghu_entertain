<?php

namespace App\Http\Controllers\BackendApi\Merchant\Report;

use App\Http\Requests\Backend\Merchant\Report\UserAuditRequest;
use App\Http\SingleActions\Backend\Merchant\Report\UserAuditAction;
use Illuminate\Http\JsonResponse;

/**
 * 报表管理
 */
class ReportController
{

    /**
     * 用户稽核-列表
     *
     * @param  UserAuditRequest $request Request.
     * @param  UserAuditAction  $action  Action.
     * @return JsonResponse
     */
    public function userAudit(UserAuditRequest $request, UserAuditAction $action): JsonResponse
    {
        $inputDatas = $request->validated();
        return $action->execute($inputDatas);
    }
}
