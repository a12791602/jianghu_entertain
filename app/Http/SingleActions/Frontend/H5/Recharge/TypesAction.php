<?php

namespace App\Http\SingleActions\Frontend\H5\Recharge;

use App\ModelFilters\Finance\SystemFinanceTypeFilter;
use App\Models\Finance\SystemFinanceType;
use Illuminate\Http\JsonResponse;

/**
 * Class TypesAction
 * @package App\Http\SingleActions\Frontend\H5\Recharge
 */
class TypesAction
{
    /**
     * @param array $inputDatas InputDatas.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(array $inputDatas): JsonResponse
    {
        $inputDatas['status'] = SystemFinanceType::STATUS_YES;
        $datas                = SystemFinanceType::filter($inputDatas, SystemFinanceTypeFilter::class)
            ->select(['id', 'name', 'sign', 'is_online'])
            ->withCacheCooldownSeconds(86400)
            ->get();
        $msgOut               = msgOut(true, $datas);
        return $msgOut;
    }
}
