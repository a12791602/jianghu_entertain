<?php

namespace App\Http\SingleActions\Common\Platform;

use App\Http\SingleActions\MainAction;
use Illuminate\Http\JsonResponse;

/**
 * 获取当前平台SSL
 */
class CurrentSslAction extends MainAction
{

    /**
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(): JsonResponse
    {
        $currentSSL = $this->currentPlatformEloq->sslKey;
        $data       = [
                       'public_key'   => $currentSSL->public_key ?? null,
                       'interval_str' => $currentSSL->interval_str ?? null,
                      ];
        return msgOut($data);
    }
}
