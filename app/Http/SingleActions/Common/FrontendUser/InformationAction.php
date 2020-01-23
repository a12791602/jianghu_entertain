<?php

namespace App\Http\SingleActions\Common\FrontendUser;

use App\Http\Requests\Frontend\Common\FrontendUser\UpdateInformationRequest;
use App\Http\Resources\Frontend\FrontendUser\DynamicInformationResource;
use App\Http\Resources\Frontend\GamesLobby\PersonalInformationResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class InformationAction
 * @package App\Http\SingleActions\Common\FrontendUser
 */
class InformationAction
{
    /**
     * Personal information.
     * @param Request $request Request.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function information(Request $request): JsonResponse
    {
        $user   = $request->user();
        $result = msgOut(PersonalInformationResource::make($user));
        return $result;
    }

    /**
     * Dynamic information.
     * @param Request $request Request.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function dynamicInformation(Request $request): JsonResponse
    {
        $user   = $request->user();
        $result = msgOut(DynamicInformationResource::make($user));
        return $result;
    }

    /**
     * Update personal information.
     * @param UpdateInformationRequest $request Update personal InformationRequest.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function update(UpdateInformationRequest $request): JsonResponse
    {
        $item = $request->only(['avatar', 'nickname']);
        $user = $request->user();
        $user->specificInfo()->update($item);
        $info   = $user->specificInfo->only(['avatar', 'nickname']);
        $result = msgOut($info);
        return $result;
    }
}
