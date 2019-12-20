<?php

namespace App\Http\Controllers\FrontendApi\H5;

use App\Http\Controllers\FrontendApi\FrontendApiMainController;
use App\Http\SingleActions\Common\FrontendUser\IndexAction;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class FrontendUserController
 * @package App\Http\Controllers\FrontendApi\H5
 */
class FrontendUserController extends FrontendApiMainController
{
    /**
     * @param IndexAction $action  Action.
     * @param Request     $request Request.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function information(IndexAction $action, Request $request): JsonResponse
    {
        $result = $action->execute($request);
        return $result;
    }
}
