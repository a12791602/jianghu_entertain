<?php

namespace App\Http\Controllers\BackendApi\Headquarters\Statistic;

use App\Http\Controllers\Controller;
use App\Http\SingleActions\Backend\Headquarters\Statistic\HeaderAction;
use App\Http\SingleActions\Backend\Headquarters\Statistic\IndexAction;
use Illuminate\Http\JsonResponse;

/**
 * Class StatisticController
 * @package App\Http\Controllers\BackendApi\Headquarters\Statistic
 */
class StatisticController extends Controller
{
    /**
     * Headquarters Homepage Statistics.
     * @param IndexAction $action Action.
     * @return JsonResponse
     */
    public function index(IndexAction $action): JsonResponse
    {
        return $action->execute();
    }

    /**
     * Header Statistics.
     * @param HeaderAction $action Action.
     * @return JsonResponse
     */
    public function header(HeaderAction $action): JsonResponse
    {
        return $action->execute();
    }
}
