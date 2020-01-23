<?php

namespace App\Http\SingleActions\Backend\Headquarters\Merchant\Platform;

use App\Models\Platform\SystemDynActivityPlatform;
use Illuminate\Http\JsonResponse;

/**
 * Class AssignedActivityCancelAction
 * @package App\Http\SingleActions\Backend\Headquarters\Merchant\Platform
 */
class AssignedActivityCancelAction
{
    /**
     * @param array $inputDatas InputDatas.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(array $inputDatas): JsonResponse
    {
        $result = SystemDynActivityPlatform::where('platform_sign', $inputDatas['platform_sign'])
            ->whereIn('activity_sign', $inputDatas['activities'])->delete();
        if ($result) {
            $msgOut = msgOut();
            return $msgOut;
        }
        throw new \Exception('302008');
    }
}
