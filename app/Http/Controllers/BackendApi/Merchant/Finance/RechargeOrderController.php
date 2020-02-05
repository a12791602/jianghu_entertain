<?php

namespace App\Http\Controllers\BackendApi\Merchant\Finance;

use App\Http\Controllers\BackendApi\BackEndApiMainController;
use App\Http\Requests\Backend\Merchant\Finance\RechargeOrder\IndexRequest;
use App\Http\SingleActions\Backend\Merchant\Finance\RechargeOrder\IndexAction;
use Illuminate\Http\JsonResponse;

/**
 * Class RechargeOrderController
 * @package App\Http\Controllers\BackendApi\Merchant\Finance
 */
class RechargeOrderController extends BackEndApiMainController
{
    /**
     * 入款订单列表.
     *
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
