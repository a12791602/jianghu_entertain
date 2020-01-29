<?php

namespace App\Http\Controllers\FrontendApi\Common;

use App\Http\Controllers\FrontendApi\FrontendApiMainController;
use App\Http\Requests\Frontend\Common\FrontendUser\InformationUpdateRequest;
use App\Http\SingleActions\Common\FrontendUser\GradesAction;
use App\Http\SingleActions\Common\FrontendUser\InformationAction;
use App\Http\SingleActions\Common\FrontendUser\PromotionGiftAction;
use App\Http\SingleActions\Common\FrontendUser\WeeklyGiftAction;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Front-end user center.
 * @package App\Http\Controllers\FrontendApi\H5
 */
class FrontendUserController extends FrontendApiMainController
{
    /**
     * Personal information.
     * @param InformationAction $action  Action.
     * @param Request           $request Request.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function information(InformationAction $action, Request $request): JsonResponse
    {
        $result = $action->information($request);
        return $result;
    }

    /**
     * Dynamic information.
     * @param InformationAction $action  Action.
     * @param Request           $request Request.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function dynamicInformation(InformationAction $action, Request $request): JsonResponse
    {
        $result = $action->dynamicInformation($request);
        return $result;
    }

    /**
     * Update personal information.
     * @param InformationAction        $action  Action.
     * @param InformationUpdateRequest $request Update personal InformationRequest.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function updateInformation(
        InformationAction $action,
        InformationUpdateRequest $request
    ): JsonResponse {
        $result = $action->update($request);
        return $result;
    }

    /**
     * Get user grade rules.
     * @param GradesAction $action  GradesAction.
     * @param Request      $request Request.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function grades(GradesAction $action, Request $request): JsonResponse
    {
        $result = $action->execute($request);
        return $result;
    }

    /**
     * Receive promotional gift.
     * @param PromotionGiftAction $action  GradesAction.
     * @param Request             $request Request.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function promotionGift(PromotionGiftAction $action, Request $request): JsonResponse
    {
        $result = $action->execute($request);
        return $result;
    }

    /**
     * Receive weekly gift .
     * @param WeeklyGiftAction $action  WeeklyGiftAction.
     * @param Request          $request Request.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function weeklyGift(WeeklyGiftAction $action, Request $request): JsonResponse
    {
        $result = $action->execute($request);
        return $result;
    }
}
