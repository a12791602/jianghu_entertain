<?php

namespace App\Http\SingleActions\Backend\Merchant\Finance\RechargeOrder;

use App\Models\Finance\SystemFinanceType;
use Illuminate\Http\JsonResponse;

/**
 * Class GetFinanceTypesAction
 * @package App\Http\SingleActions\Backend\Merchant\Finance\RechargeOrder
 */
class GetFinanceTypesAction
{
    /**
     * @param array $inputDatas InputDatas.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(array $inputDatas): JsonResponse
    {
        $financeTypes = SystemFinanceType::where('is_online', $inputDatas['is_online'])
            ->get(
                [
                 'id',
                 'name',
                ],
            );
        return msgOut($financeTypes);
    }
}
