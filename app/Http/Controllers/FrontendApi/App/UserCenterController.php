<?php

namespace App\Http\Controllers\FrontendApi\App;

use App\Http\Requests\Frontend\Common\FrontendUser\InformationUpdateRequest;
use App\Http\Requests\Frontend\Common\GamesLobby\ClaimGiftRequest;
use App\Http\SingleActions\Frontend\App\UserCenter\InformationAction;
use App\Http\SingleActions\Frontend\Common\FrontendUser\CheckBenefitsAction;
use App\Http\SingleActions\Frontend\Common\FrontendUser\ClaimBenefitsAction;
use Illuminate\Http\JsonResponse;

/**
 * Front-end user center.
 * @package App\Http\Controllers\FrontendApi\H5
 */
class UserCenterController
{

    /**
     * Personal information.
     * @param InformationAction $action Action.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function information(InformationAction $action): JsonResponse
    {
        return $action->information();
    }

    /**
     * Dynamic information.
     * @param InformationAction $action Action.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function dynamicInformation(InformationAction $action): JsonResponse
    {
        return $action->dynamicInformation();
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
        return $action->update($request);
    }

    /**
     * Claim a gift.
     * @param ClaimBenefitsAction $action  ClaimBenefitsAction.
     * @param ClaimGiftRequest    $request ClaimGiftRequest.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function claimBenefits(
        ClaimBenefitsAction $action,
        ClaimGiftRequest $request
    ): JsonResponse {
        $validated = $request->validated();
        return $action->execute($validated);
    }

    /**
     * 查询对应等级的权益状态.
     * @param CheckBenefitsAction $action CheckBenefitsAction.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function checkBenefits(CheckBenefitsAction $action): JsonResponse
    {
        return $action->execute();
    }
}
