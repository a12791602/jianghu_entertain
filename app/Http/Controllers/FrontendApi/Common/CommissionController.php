<?php

namespace App\Http\Controllers\FrontendApi\Common;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\Common\Commission\RebateRequest;
use App\Http\Requests\Frontend\Common\Commission\ReportRequest;
use App\Http\SingleActions\Frontend\Common\Commission\RebateAction;
use App\Http\SingleActions\Frontend\Common\Commission\ReportAction;
use Illuminate\Http\JsonResponse;

/**
 * 佣金
 * @package App\Http\Controllers\FrontendApi\Common
 */
class CommissionController extends Controller
{

    /**
     * @param RebateAction  $action  Action.
     * @param RebateRequest $request Request.
     * @return JsonResponse
     */
    public function rebate(
        RebateAction $action,
        RebateRequest $request
    ): JsonResponse {
        $inputDatas = $request->validated();
        return $action->execute($inputDatas);
    }

    /**
     * @param ReportAction  $action  Action.
     * @param ReportRequest $request Request.
     * @return JsonResponse
     */
    public function report(
        ReportAction $action,
        ReportRequest $request
    ): JsonResponse {
        $inputDatas = $request->validated();
        return $action->execute($inputDatas);
    }
}
