<?php

namespace App\Http\Controllers\FrontendApi\Common;

use App\Http\Controllers\FrontendApi\FrontendApiMainController;
use App\Http\SingleActions\Common\FrontendUser\GradesAction;
use App\Http\SingleActions\Common\FrontendUser\InformationAction;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Front-end user center.
 * @package App\Http\Controllers\FrontendApi\H5
 */
class FrontendUserController extends FrontendApiMainController
{
    /**
     * Personal information.
     * @param InformationAction $action  Action.
     * @param Request           $request Request.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function information(InformationAction $action, Request $request): JsonResponse
    {
        $result = $action->information($request);
        return $result;
    }

    /**
     * Home personal information.
     * @param InformationAction $action  Action.
     * @param Request           $request Request.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function homeInformation(InformationAction $action, Request $request): JsonResponse
    {
        $result = $action->homeInformation($request);
        return $result;
    }

    /**
     * Get user grade rules.
     * @param GradesAction $action  GradesAction.
     * @param Request      $request Request.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function grades(GradesAction $action, Request $request): JsonResponse
    {
        $result = $action->execute($request);
        return $result;
    }
}
