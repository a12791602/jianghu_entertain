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
        $criteria                = $inputDatas;
        $criteria['platform_id'] = $this->currentPlatformEloq->id;
        $criteria['status']      = JHHYCnst::STATUS_OPEN;
        $activityIdenti          = ActivitiesDynPlatform::filter($criteria)->first();
        if (!$activityIdenti instanceof ActivitiesDynPlatform) {
            throw new \Exception('500000');
        }
        $activity = $activityIdenti->activitySystem;
        if (!isset($activity->activity_class)) {
            throw new \Exception('500004');
        }
        $acInstance = $activity->activity_class;
        $acInstance->setRequirements($this->user);
        $result = $acInstance->draw();
        return msgOut($result);
    }
}
