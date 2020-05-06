<?php

namespace App\Http\SingleActions\Backend\Merchant\Finance\Online;

use App\Http\Resources\Backend\Merchant\Finance\Online\BankIndexResource;
use App\Models\Finance\SystemPlatformBank;
use Illuminate\Http\JsonResponse;

/**
 * Class BankIndexAction
 * @package App\Http\SingleActions\Backend\Merchant\Finance\Online
 */
class BankIndexAction extends BaseAction
{
    /**
     * @param array $inputData InputData.
     * @return JsonResponse
     */
    public function execute(array $inputData): JsonResponse
    {
        $result = SystemPlatformBank::with('bank')
            ->filter($inputData)
            ->where('platform_sign', $this->currentPlatformEloq->sign)
            ->get();
        return msgOut(BankIndexResource::collection($result));
    }
}
