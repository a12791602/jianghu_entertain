<?php

namespace App\Http\Controllers\FrontendApi\Common;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\Common\Commission\RebateRequest;
use App\Http\SingleActions\Frontend\Common\Commission\RebateAction;
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
}
