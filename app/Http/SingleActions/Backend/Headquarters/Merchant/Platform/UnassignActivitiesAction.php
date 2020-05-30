<?php

namespace App\Http\SingleActions\Backend\Headquarters\Merchant\Platform;

use App\Http\SingleActions\MainAction;
use App\Models\Activity\ActivitiesDynSystem;
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
        $inputDatas['unassign_platform_sign'] = $inputDatas['platform_sign'];

        $systemDynActivity = new ActivitiesDynSystem();
        if (isset($inputDatas['pageSize'])) {
            $systemDynActivity->setPerPage($inputDatas['pageSize']);
        }
        $outputDatas = $systemDynActivity->filter($inputDatas)
            ->paginate();
        return msgOut($outputDatas);
    }
}
