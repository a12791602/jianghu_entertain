<?php

namespace App\Http\SingleActions\Frontend\Common\DynamicActivities;

use App\Http\SingleActions\MainAction;
use App\Models\Activity\ActivitiesDynSystem;
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
        $result   = 0;
        $activity = ActivitiesDynSystem::find($inputDatas['activity_id']);
        if (isset($activity->activity_class)) {
            $acInstance = $activity->activity_class;
            $result     = $acInstance->draw();
        }
        return msgOut($result);
    }
}
