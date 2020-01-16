<?php

namespace App\Http\SingleActions\Common\FrontendUser;

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
}
