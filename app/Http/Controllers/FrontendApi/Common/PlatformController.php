<?php

namespace App\Http\Controllers\FrontendApi\Common;

use App\Http\Controllers\Controller;
use App\Http\SingleActions\Common\Platform\CurrentSslAction;
use Illuminate\Http\JsonResponse;

/**
 * 平台相关
 * @package App\Http\Controllers\FrontendApi\Common
 */
class PlatformController extends Controller
{

    /**
     * Personal information.
     * @param CurrentSslAction $action Action.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function currentSsl(CurrentSslAction $action): JsonResponse
    {
        return $action->execute();
    }
}
