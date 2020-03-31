<?php

namespace App\Http\SingleActions\Frontend\H5\UserCenter;

use App\Http\Requests\Frontend\Common\FrontendUser\InformationUpdateRequest;
use App\Http\Resources\Frontend\FrontendUser\DynamicInformationResource;
use App\Http\Resources\Frontend\GamesLobby\PersonalInformationResource;
use App\Http\SingleActions\MainAction;
use Illuminate\Http\JsonResponse;

/**
 * Class InformationAction
 * @package App\Http\SingleActions\Common\FrontendUser
 */
class InformationAction extends MainAction
{

    /**
     * Personal information.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function information(): JsonResponse
    {
        return msgOut(PersonalInformationResource::make($this->user));
    }

    /**
     * Dynamic information.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function dynamicInformation(): JsonResponse
    {
        return msgOut(DynamicInformationResource::make($this->user));
    }

    /**
     * Update personal information.
     * @param InformationUpdateRequest $request Update personal InformationRequest.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function update(InformationUpdateRequest $request): JsonResponse
    {
        $item = $request->validated();
        $this->user->specificInfo()->update($item);
        return msgOut([], '100803');
    }
}
