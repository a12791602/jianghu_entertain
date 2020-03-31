<?php

namespace App\Http\SingleActions\Backend\Headquarters\Merchant\Platform;

use App\Http\SingleActions\MainAction;
use App\ModelFilters\Activity\SystemDynActivityFilter;
use App\Models\Activity\SystemDynActivity;
use Illuminate\Http\JsonResponse;

/**
 * Class UnassignActivitiesAction
 * @package App\Http\SingleActions\Backend\Headquarters\Merchant\Platform
 */
class UnassignActivitiesAction extends MainAction
{
    /**
     * @param array $inputDatas InputDatas.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(array $inputDatas): JsonResponse
    {
        $pageSize                             = SystemDynActivity::getPageSize();
        $inputDatas['unassign_platform_sign'] = $inputDatas['platform_sign'];
        $outputDatas                          = SystemDynActivity::filter($inputDatas, SystemDynActivityFilter::class)
            ->paginate($pageSize);
        return msgOut($outputDatas);
    }
}
