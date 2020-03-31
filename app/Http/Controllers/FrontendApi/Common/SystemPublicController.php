<?php

namespace App\Http\Controllers\FrontendApi\Common;

use App\Http\SingleActions\Frontend\Common\System\SystemAvatarAction;
use App\Http\SingleActions\Frontend\Common\System\SystemSupportedBanksAction;
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
        return $action->execute();
    }

    /**
     * System supported banks.
     * @param SystemSupportedBanksAction $action System supported banks.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function bank(SystemSupportedBanksAction $action): JsonResponse
    {
        return $action->execute();
    }
}
