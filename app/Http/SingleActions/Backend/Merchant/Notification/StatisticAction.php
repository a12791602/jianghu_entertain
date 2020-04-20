<?php

namespace App\Http\SingleActions\Backend\Merchant\Notification;

use App\Http\SingleActions\MainAction;
use App\Models\Notification\MerchantNotificationStatistic;
use Illuminate\Http\JsonResponse;

/**
 * Class IndexAction
 * @package App\Http\SingleActions\Backend\Merchant\Notice\System
 */
class StatisticAction extends MainAction
{

    /**
     * ***
     * @return JsonResponse
     */
    public function execute(): JsonResponse
    {
        $condition = [];

        $condition['platform_id'] = $this->currentPlatformEloq->id;

        $data = MerchantNotificationStatistic::where($condition)->get();
        return msgOut($data);
    }
}
