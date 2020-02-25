<?php

namespace App\Http\SingleActions\Frontend\Common\FrontendUser;

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
        $result = msgOut(PersonalInformationResource::make($this->user));
        return $result;
    }

    /**
     * Dynamic information.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function dynamicInformation(): JsonResponse
    {
        $result = msgOut(DynamicInformationResource::make($this->user));
        return $result;
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
        $result = msgOut([], '100803');
        return $result;
    }
}
