<?php

namespace App\Http\SingleActions\Backend\Headquarters\Merchant\Platform;

use App\Http\SingleActions\MainAction;
use App\ModelFilters\Activity\SystemDynActivityFilter;
use App\Models\Activity\SystemDynActivity;
use Illuminate\Http\JsonResponse;

/**
 * Class AssignedActivitiesAction
 * @package App\Http\SingleActions\Backend\Headquarters\Merchant\Platform
 */
class AssignedActivitiesAction extends MainAction
{
    /**
     * @param array $inputDatas InputDatas.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(array $inputDatas): JsonResponse
    {
        $systemDynActivity = new SystemDynActivity();
        if (isset($inputDatas['pageSize'])) {
            $systemDynActivity->setPerPage($inputDatas['pageSize']);
        }
        $inputDatas['assigned_platform_sign'] = $inputDatas['platform_sign'];
        $outputDatas                          = $systemDynActivity->filter($inputDatas, SystemDynActivityFilter::class)
            ->paginate();
        return msgOut($outputDatas);
    }
}
