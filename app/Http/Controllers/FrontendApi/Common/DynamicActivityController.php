<?php

namespace App\Http\Controllers\FrontendApi\Common;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\Common\DynamicActivity\ParticipateRequest;
use App\Http\SingleActions\Frontend\Common\DynamicActivities\ParticipateAction;
use Illuminate\Http\JsonResponse;

/**
 * Class System PublicController
 * @package App\Http\Controllers\FrontendApi\Common
 */
class DynamicActivityController extends Controller
{

    /**
     * 参与活动
     * @param ParticipateAction  $action  System public avatar.
     * @param ParticipateRequest $request Request.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function participate(
        ParticipateAction $action,
        ParticipateRequest $request
    ): JsonResponse {
        $inputDatas = $request->validated();
        return $action->execute($inputDatas);
    }
}
