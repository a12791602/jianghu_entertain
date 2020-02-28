<?php

namespace App\Http\SingleActions\Backend\Merchant\Bank;

use App\Models\Finance\SystemBank;
use Illuminate\Http\JsonResponse;

/**
 * Class GetSystemBanksAction
 * @package App\Http\SingleActions\Backend\Merchant\Bank
 */
class GetSystemBanksAction
{
    /**
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(): JsonResponse
    {
        $model  = new SystemBank();
        $banks  = $model->where('status', SystemBank::STATUS_OPEN)
            ->withCacheCooldownSeconds(86400)
            ->get(['id', 'name', 'code']);
        $result = msgOut($banks);
        return $result;
    }
}
