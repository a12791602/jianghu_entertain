<?php

namespace App\Http\SingleActions\Backend\Merchant\Admin\MerchantAdminUser;

use App\Http\Controllers\BackendApi\BackEndApiMainController;
use Illuminate\Http\JsonResponse;

/**
 * Class for all admins action.
 */
class AllAdminsAction
{
    /**
     * 获取所有当前平台的商户管理员用户
     *
     * @param  BackEndApiMainController $contll Controller.
     * @return JsonResponse
     */
    public function execute(BackEndApiMainController $contll): JsonResponse
    {
        $data   = $contll->currentPlatformEloq->adminUsers->toArray();
        $msgOut = msgOut(true, $data);
        return $msgOut;
    }
}
