<?php

namespace App\Http\SingleActions\Frontend\Common\DynamicActivities;

use App\Http\SingleActions\MainAction;
use App\Lib\Constant\JHHYCnst;
use App\Models\Activity\ActivitiesDynPlatform;
use Illuminate\Http\JsonResponse;

/**
 * Class InGameAction
 * @package App\Http\SingleActions\Frontend\Common\GamesLobby
 */
class ParticipateAction extends MainAction
{
    /**
     * @param array $inputDatas InputDatas.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(array $inputDatas): JsonResponse
    {
        $result                  = 0;
        $criteria                = $inputDatas;
        $criteria['platform_id'] = $this->currentPlatformEloq->id;
        $criteria['status']      = JHHYCnst::STATUS_OPEN;
        $activityIdenti          = ActivitiesDynPlatform::filter($criteria)->first();
        $activity                = $activityIdenti->activitySystem;
        if (isset($activity->activity_class)) {
            $acInstance = $activity->activity_class;
            $result     = $acInstance->draw();
        }
        return msgOut($result);
    }
}
