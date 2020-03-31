<?php

namespace App\Http\Controllers\BackendApi\Merchant\Bank;

use App\Http\Requests\Backend\Merchant\Bank\IndexRequest;
use App\Http\Requests\Backend\Merchant\Bank\StatusRequest;
use App\Http\SingleActions\Backend\Merchant\Bank\GetSystemBanksAction;
use App\Http\SingleActions\Backend\Merchant\Bank\IndexAction;
use App\Http\SingleActions\Backend\Merchant\Bank\StatusAction;
use Illuminate\Http\JsonResponse;

/**
 * Class BankController
 * @package App\Http\Controllers\BackendApi\Merchant\Bank
 */
class BankController
{
    /**
     * 获取银行列表
     * @param GetSystemBanksAction $action Action.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function getSystemBanks(GetSystemBanksAction $action): JsonResponse
    {
        return $action->execute();
    }

    /**
     * 银行卡列表.
     *
     * @param IndexAction  $action  Action.
     * @param IndexRequest $request Request.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function index(IndexAction $action, IndexRequest $request): JsonResponse
    {
        $inputDatas = $request->validated();
        return $action->execute($inputDatas);
    }

    /**
     * 改变状态
     *
     * @param StatusAction  $action  Action.
     * @param StatusRequest $request Request.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function status(StatusAction $action, StatusRequest $request): JsonResponse
    {
        $inputDatas = $request->validated();
        return $action->execute($inputDatas);
    }
}
