<?php

namespace App\Http\SingleActions\Backend\Merchant\Finance\Online;

use App\Models\Finance\SystemFinanceChannel;
use Illuminate\Http\JsonResponse;

/**
 * Class GetChannelsAction
 * @package App\Http\SingleActions\Backend\Merchant\Finance\Online
 */
class GetChannelsAction
{
    /**
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(): JsonResponse
    {
        $financeChannels = SystemFinanceChannel::where('status', SystemFinanceChannel::STATUS_YES)
            ->select(['id', 'name', 'sign', 'request_url'])
            ->withCacheCooldownSeconds(86400)
            ->get();
        $msgOut          = msgOut($financeChannels);
        return $msgOut;
    }
}
