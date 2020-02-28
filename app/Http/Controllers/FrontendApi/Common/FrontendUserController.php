<?php

namespace App\Http\Controllers\FrontendApi\Common;

use App\Http\Requests\Frontend\Common\FrontendUser\InformationUpdateRequest;
use App\Http\Requests\Frontend\Common\GamesLobby\ClaimGiftRequest;
use App\Http\SingleActions\Frontend\Common\FrontendUser\CheckBenefitsAction;
use App\Http\SingleActions\Frontend\Common\FrontendUser\ClaimBenefitsAction;
use App\Http\SingleActions\Frontend\Common\FrontendUser\InformationAction;
use App\Http\SingleActions\Frontend\Common\FrontendUser\UserLevelAction;
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
     * @param UserLevelAction $action UserLevelAction.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function grades(UserLevelAction $action): JsonResponse
    {
        $result = $action->execute();
        return $result;
    }

    /**
     * Claim a gift.
     * @param ClaimBenefitsAction $action  ClaimBenefitsAction.
     * @param ClaimGiftRequest    $request ClaimGiftRequest.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function claimGift(ClaimBenefitsAction $action, ClaimGiftRequest $request): JsonResponse
    {
        $result = $action->execute($request->validated());
        return $result;
    }

    /**
     * 查询对应等级的权益状态.
     * @param CheckBenefitsAction $action CheckBenefitsAction.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function checkGift(CheckBenefitsAction $action): JsonResponse
    {
        $result = $action->execute();
        return $result;
    }
}
