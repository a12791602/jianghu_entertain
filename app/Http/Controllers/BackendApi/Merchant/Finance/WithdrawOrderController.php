<?php

namespace App\Http\Controllers\BackendApi\Merchant\Finance;

use App\Http\Requests\Backend\Merchant\Finance\WithdrawOrder\CheckIndexRequest;
use App\Http\Requests\Backend\Merchant\Finance\WithdrawOrder\CheckPassRequest;
use App\Http\Requests\Backend\Merchant\Finance\WithdrawOrder\CheckRefuseRequest;
use App\Http\Requests\Backend\Merchant\Finance\WithdrawOrder\OutIndexRequest;
use App\Http\Requests\Backend\Merchant\Finance\WithdrawOrder\OutRefuseRequest;
use App\Http\Requests\Backend\Merchant\Finance\WithdrawOrder\OutSuccessRequest;
use App\Http\SingleActions\Backend\Merchant\Finance\WithdrawOrder\CheckIndexAction;
use App\Http\SingleActions\Backend\Merchant\Finance\WithdrawOrder\CheckPassAction;
use App\Http\SingleActions\Backend\Merchant\Finance\WithdrawOrder\CheckRefuseAction;
use App\Http\SingleActions\Backend\Merchant\Finance\WithdrawOrder\OutIndexAction;
use App\Http\SingleActions\Backend\Merchant\Finance\WithdrawOrder\OutRefuseAction;
use App\Http\SingleActions\Backend\Merchant\Finance\WithdrawOrder\OutSuccessAction;
use Illuminate\Http\JsonResponse;

/**
 * Class WithdrawOrderController
 * @package App\Http\Controllers\BackendApi\Merchant\Finance
 */
class WithdrawOrderController
{
    /**
     * 审核出款列表.
     *
     * @param CheckIndexAction  $action  Action.
     * @param CheckIndexRequest $request Request.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function checkIndex(
        CheckIndexAction $action,
        CheckIndexRequest $request
    ): JsonResponse {
        $inputDatas = $request->validated();
        return $action->execute($inputDatas);
    }

    /**
     * 审核通过.
     *
     * @param CheckPassAction  $action  Action.
     * @param CheckPassRequest $request Request.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function checkPass(
        CheckPassAction $action,
        CheckPassRequest $request
    ): JsonResponse {
        $inputDatas = $request->validated();
        return $action->execute($inputDatas);
    }

    /**
     * 审核拒绝.
     *
     * @param CheckRefuseAction  $action  Action.
     * @param CheckRefuseRequest $request Request.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function checkRefuse(
        CheckRefuseAction $action,
        CheckRefuseRequest $request
    ): JsonResponse {
        $inputDatas = $request->validated();
        return $action->execute($inputDatas);
    }

    /**
     * 出款列表.
     *
     * @param OutIndexAction  $action  Action.
     * @param OutIndexRequest $request Request.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function outIndex(
        OutIndexAction $action,
        OutIndexRequest $request
    ): JsonResponse {
        $inputDatas = $request->validated();
        return $action->execute($inputDatas);
    }

    /**
     * 出款成功.
     *
     * @param OutSuccessAction  $action  Action.
     * @param OutSuccessRequest $request Request.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function outSuccess(
        OutSuccessAction $action,
        OutSuccessRequest $request
    ): JsonResponse {
        $inputDatas = $request->validated();
        return $action->execute($inputDatas);
    }

    /**
     * 出款拒绝.
     *
     * @param OutRefuseAction  $action  Action.
     * @param OutRefuseRequest $request Request.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function outRefuse(
        OutRefuseAction $action,
        OutRefuseRequest $request
    ): JsonResponse {
        $inputDatas = $request->validated();
        return $action->execute($inputDatas);
    }
}
