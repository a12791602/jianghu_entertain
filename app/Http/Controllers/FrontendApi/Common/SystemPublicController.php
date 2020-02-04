<?php

namespace App\Http\Controllers\FrontendApi\Common;

use App\Http\SingleActions\Frontend\Common\System\SystemAvatarAction;
use Illuminate\Http\JsonResponse;

/**
 * Class System PublicController
 * @package App\Http\Controllers\FrontendApi\Common
 */
class SystemPublicController
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
