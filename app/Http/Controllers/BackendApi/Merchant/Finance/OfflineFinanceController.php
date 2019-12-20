<?php

namespace App\Http\Controllers\BackendApi\Merchant\Finance;

use App\Http\Controllers\BackendApi\BackEndApiMainController;
use App\Http\Requests\Backend\Merchant\Finance\Offline\AddDoRequest;
use App\Http\Requests\Backend\Merchant\Finance\Offline\IndexRequest;
use App\Http\SingleActions\Backend\Merchant\Finance\Offline\AddDoAction;
use App\Http\SingleActions\Backend\Merchant\Finance\Offline\IndexAction;
use Illuminate\Http\JsonResponse;

/**
 * Class OfflineFinanceController
 * @package App\Http\Controllers\BackendApi\Merchant\Finance
 */
class OfflineFinanceController extends BackEndApiMainController
{
    /**
     * @param AddDoAction  $action  Action.
     * @param AddDoRequest $request Request.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function addDo(AddDoAction $action, AddDoRequest $request): JsonResponse
    {
        $inputDatas  = $request->validated();
        $outputDatas = $action->execute($this, $inputDatas);
        return $outputDatas;
    }

    /**
     * @param IndexAction  $action  Action.
     * @param IndexRequest $request Request.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function index(IndexAction $action, IndexRequest $request): JsonResponse
    {
        $inputDatas  = $request->validated();
        $outputDatas = $action->execute($this, $inputDatas);
        return $outputDatas;
    }
}
