<?php

namespace App\Http\SingleActions\Backend\Headquarters\Merchant\Platform;

use App\Models\Platform\SystemDynActivityPlatform;
use Illuminate\Http\JsonResponse;

/**
 * Class AssignActivitiesAction
 * @package App\Http\SingleActions\Backend\Headquarters\Merchant\Platform
 */
class AssignActivitiesAction
{
    /**
     * @param array $inputDatas InputDatas.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(array $inputDatas): JsonResponse
    {
        $data = [];
        foreach ($inputDatas['activities'] as $activity) {
            $tmpData                  = [];
            $tmpData['platform_sign'] = $inputDatas['platform_sign'];
            $tmpData['activity_sign'] = $activity;
            $data[]                   = $tmpData;
        }
        try {
            SystemDynActivityPlatform::insert($data);
            $msgOut = msgOut();
            return $msgOut;
        } catch (\Throwable $exception) {
            throw new \Exception('302007');
        }
    }
}
