<?php

namespace App\Http\Controllers\BackendApi\Merchant\Finance;

use App\Http\Requests\Backend\Merchant\Finance\HandleSaveBuckle\BuckleIndexRequest;
use App\Http\Requests\Backend\Merchant\Finance\HandleSaveBuckle\HandleBuckleRequest;
use App\Http\Requests\Backend\Merchant\Finance\HandleSaveBuckle\HandleSaveRequest;
use App\Http\Requests\Backend\Merchant\Finance\HandleSaveBuckle\SaveIndexRequest;
use App\Http\SingleActions\Backend\Merchant\Finance\HandleSaveBuckle\BuckleIndexAction;
use App\Http\SingleActions\Backend\Merchant\Finance\HandleSaveBuckle\HandleBuckleAction;
use App\Http\SingleActions\Backend\Merchant\Finance\HandleSaveBuckle\HandleSaveAction;
use App\Http\SingleActions\Backend\Merchant\Finance\HandleSaveBuckle\SaveIndexAction;
use Illuminate\Http\JsonResponse;

/**
 * Class HandleSaveBuckleRecordController
 * @package App\Http\Controllers\BackendApi\Merchant\Finance
 */
class HandleSaveBuckleRecordController
{
    /**
     * 人工存款.
     *
     * @param HandleSaveAction  $action  Action.
     * @param HandleSaveRequest $request Request.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function handleSave(
        HandleSaveAction $action,
        HandleSaveRequest $request
    ): JsonResponse {
        $inputDatas  = $request->validated();
        $outputDatas = $action->execute($inputDatas);
        return $outputDatas;
    }

    /**
     * 人工存款列表.
     *
     * @param SaveIndexAction  $action  Action.
     * @param SaveIndexRequest $request Request.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function saveIndex(
        SaveIndexAction $action,
        SaveIndexRequest $request
    ): JsonResponse {
        $inputDatas  = $request->validated();
        $outputDatas = $action->execute($inputDatas);
        return $outputDatas;
    }

    /**
     * 人工扣款.
     *
     * @param HandleBuckleAction  $action  Action.
     * @param HandleBuckleRequest $request Request.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function handleBuckle(
        HandleBuckleAction $action,
        HandleBuckleRequest $request
    ): JsonResponse {
        $inputDatas  = $request->validated();
        $outputDatas = $action->execute($inputDatas);
        return $outputDatas;
    }

    /**
     * 人工扣款列表.
     *
     * @param BuckleIndexAction  $action  Action.
     * @param BuckleIndexRequest $request Request.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function buckleIndex(
        BuckleIndexAction $action,
        BuckleIndexRequest $request
    ): JsonResponse {
        $inputDatas  = $request->validated();
        $outputDatas = $action->execute($inputDatas);
        return $outputDatas;
    }
}
