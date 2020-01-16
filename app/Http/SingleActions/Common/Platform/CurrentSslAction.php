<?php

namespace App\Http\SingleActions\Common\Platform;

use App\Http\Controllers\FrontendApi\FrontendApiMainController;
use Illuminate\Http\JsonResponse;

/**
 * 获取当前平台SSL
 */
class CurrentSslAction
{

    /**
     * @param  FrontendApiMainController $contll Controller.
     * @return JsonResponse
     */
    public function execute(FrontendApiMainController $contll): JsonResponse
    {
        $currentSSL = $contll->currentPlatformEloq->sslKey;
        $data       = [
                       'public_key'   => $currentSSL->public_key ?? null,
                       'interval_str' => $currentSSL->interval_str ?? null,
                      ];
        $msgOut     = msgOut($data);
        return $msgOut;
    }
}
