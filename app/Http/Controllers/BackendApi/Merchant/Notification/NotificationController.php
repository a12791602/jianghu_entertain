<?php

namespace App\Http\Controllers\BackendApi\Merchant\Notification;

use App\Http\Controllers\Controller;
use App\Http\SingleActions\Backend\Merchant\Notification\StatisticAction;
use Illuminate\Http\JsonResponse;

/**
 * Class NotificationController
 * @package App\Http\Controllers\BackendApi\Merchant\Notification
 */
class NotificationController extends Controller
{

    /**
     * 通知统计.
     * @param StatisticAction $action Action.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function statistic(StatisticAction $action): JsonResponse
    {
        return $action->execute();
    }
}
