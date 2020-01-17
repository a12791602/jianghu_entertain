<?php

namespace App\Http\Controllers\FrontendApi\Common;

use App\Http\Controllers\FrontendApi\FrontendApiMainController;
use App\Http\SingleActions\Frontend\Common\SystemAvatarAction;
use Illuminate\Http\JsonResponse;

/**
 * Class System PublicController
 * @package App\Http\Controllers\FrontendApi\Common
 */
class SystemPublicController extends FrontendApiMainController
{

    /**
     * System avatar list.
     * @param SystemAvatarAction $action System public avatar.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function avatar(SystemAvatarAction $action): JsonResponse
    {
        $result = $action->execute();
        return $result;
    }
}
