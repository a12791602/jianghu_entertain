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
     * @return JsonResponse
     * @throws \RuntimeException RuntimeException.
     */
    public function execute(): JsonResponse
    {
        $result = SystemPlatformBank::with('bank')->where('platform_sign', $this->currentPlatformEloq->sign)->get();
        $msgOut = msgOut(BankIndexResource::collection($result));
        return $msgOut;
    }
}
