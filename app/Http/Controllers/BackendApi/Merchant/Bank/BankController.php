<?php

namespace App\Http\Controllers\BackendApi\Merchant\Bank;

use App\Http\Controllers\BackendApi\BackEndApiMainController;
use App\Http\SingleActions\Backend\Merchant\Bank\GetSystemBanksAction;
use Illuminate\Http\JsonResponse;

/**
 * Class BankController
 * @package App\Http\Controllers\BackendApi\Merchant\Bank
 */
class BankController extends BackEndApiMainController
{
    /**
     * 获取银行列表
     * @param GetSystemBanksAction $action Action.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function getSystemBanks(GetSystemBanksAction $action): JsonResponse
    {
        $outputDatas = $action->execute();
        return $outputDatas;
    }
}
