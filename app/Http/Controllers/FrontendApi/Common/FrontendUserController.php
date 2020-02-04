<?php

namespace App\Http\Controllers\FrontendApi\Common;

use App\Http\Requests\Frontend\Common\FrontendUser\InformationUpdateRequest;
use App\Http\SingleActions\Frontend\Common\FrontendUser\GradesAction;
use App\Http\SingleActions\Frontend\Common\FrontendUser\InformationAction;
use App\Http\SingleActions\Frontend\Common\FrontendUser\PromotionGiftAction;
use App\Http\SingleActions\Frontend\Common\FrontendUser\WeeklyGiftAction;
use Illuminate\Http\JsonResponse;

/**
 * Front-end user center.
 * @package App\Http\Controllers\FrontendApi\H5
 */
class FrontendUserController
{
    /**
     * Personal information.
     * @param InformationAction $action Action.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function information(InformationAction $action): JsonResponse
    {
        $result = $action->information();
        return $result;
    }

    /**
     * Dynamic information.
     * @param InformationAction $action Action.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function dynamicInformation(InformationAction $action): JsonResponse
    {
        $result = $action->dynamicInformation();
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
     * @param GradesAction $action GradesAction.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function grades(GradesAction $action): JsonResponse
    {
        $result = $action->execute();
        return $result;
    }

    /**
     * Receive promotional gift.
     * @param PromotionGiftAction $action GradesAction.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function promotionGift(PromotionGiftAction $action): JsonResponse
    {
        $result = $action->execute();
        return $result;
    }

    /**
     * Receive weekly gift .
     * @param WeeklyGiftAction $action WeeklyGiftAction.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function weeklyGift(WeeklyGiftAction $action): JsonResponse
    {
        $result = $action->execute();
        return $result;
    }
}
