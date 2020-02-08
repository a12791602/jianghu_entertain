<?php

namespace App\Http\Controllers\BackendApi\Merchant\Finance;

use App\Http\Requests\Backend\Merchant\Finance\HandleSaveBuckle\HandleSaveRequest;
use App\Http\SingleActions\Backend\Merchant\Finance\HandleSaveBuckle\HandleSaveAction;
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
}
