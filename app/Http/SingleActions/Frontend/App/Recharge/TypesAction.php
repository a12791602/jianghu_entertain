<?php

namespace App\Http\SingleActions\Frontend\App\Recharge;

use App\ModelFilters\Finance\SystemFinanceTypeFilter;
use App\Models\Finance\SystemFinanceType;
use Illuminate\Http\JsonResponse;

/**
 * Class TypesAction
 * @package App\Http\SingleActions\Frontend\App\Recharge
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
        $inputDatas['status']    = SystemFinanceType::STATUS_YES;
        $inputDatas['direction'] = SystemFinanceType::DIRECTION_IN;
        $datas                   = SystemFinanceType::filter($inputDatas, SystemFinanceTypeFilter::class)
            ->withCacheCooldownSeconds(86400)
            ->get(['id', 'name', 'sign', 'is_online']);
        return msgOut($datas);
    }
}
