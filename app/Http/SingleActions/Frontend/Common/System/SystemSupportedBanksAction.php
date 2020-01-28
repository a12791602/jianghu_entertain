<?php

namespace App\Http\SingleActions\Frontend\Common\System;

use App\Models\Finance\SystemBank;
use Illuminate\Http\JsonResponse;

/**
 * Class SystemSupportedBanksAction
 * @package App\Http\SingleActions\Frontend\Common\System
 */
class SystemSupportedBanksAction
{
    /**
     * System supported banks.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(): JsonResponse
    {
        $item   = SystemBank::where('status', SystemBank::STATUS_OPEN)->get(['name', 'code']);
        $result = msgOut($item);
        return $result;
    }
}
