<?php

namespace App\Http\SingleActions\Common\FrontendUser;

use App\Http\Resources\HomePersonalInformationResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class IndexAction
 * @package App\Http\SingleActions\Common\FrontendUser
 */
class ShowAction
{
    /**
     * Personal information.
     * @param Request $request Request.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(Request $request): JsonResponse
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
