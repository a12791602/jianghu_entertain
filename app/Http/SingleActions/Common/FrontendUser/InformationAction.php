<?php

namespace App\Http\SingleActions\Common\FrontendUser;

use App\Http\Resources\Frontend\GamesLobby\HomePersonalInformationResource;
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
        $user   = $request->user()->only(['uid','username','pic_path','level_deep']);
        $result = msgOut(true, $user);
        return $result;
    }

    /**
     * Home personal information.
     * @param Request $request Request.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function homeInformation(Request $request): JsonResponse
    {
        $user   = $request->user();
        $result = msgOut(true, HomePersonalInformationResource::make($user));
        return $result;
    }
}
