<?php

namespace App\Http\Controllers\FrontendApi\Common;

use App\Http\Controllers\FrontendApi\FrontendApiMainController;
use App\Http\SingleActions\Common\FrontendUser\ShowAction;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class FrontendUserController
 * @package App\Http\Controllers\FrontendApi\H5
 */
class FrontendUserController extends FrontendApiMainController
{
    /**
     * Personal information.
     * @param ShowAction $action  Action.
     * @param Request    $request Request.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function information(ShowAction $action, Request $request): JsonResponse
    {
        $result = $action->execute($request);
        return $result;
    }

    /**
     * Home personal information.
     * @param ShowAction $action  Action.
     * @param Request    $request Request.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function homeInformation(ShowAction $action, Request $request): JsonResponse
    {
        $result = $action->homeInformation($request);
        return $result;
    }
}
