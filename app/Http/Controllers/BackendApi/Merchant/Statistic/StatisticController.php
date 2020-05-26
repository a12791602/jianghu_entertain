<?php

namespace App\Http\Controllers\BackendApi\Merchant\Statistic;

use App\Http\Controllers\Controller;
use App\Http\SingleActions\Backend\Merchant\Statistic\IndexAction;
use Illuminate\Http\JsonResponse;

/**
 * Class StatisticController
 * @package App\Http\Controllers\BackendApi\Headquarters\Statistic
 */
class StatisticController extends Controller
{
    /**
     * Merchant Homepage Statistics.
     * @param IndexAction $action Action.
     * @return JsonResponse
     */
    public function index(IndexAction $action): JsonResponse
    {
        return $action->execute();
    }
}
