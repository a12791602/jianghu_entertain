<?php

namespace App\Http\SingleActions\Backend\Merchant\Setting\Admin;

use App\Http\SingleActions\MainAction;
use Illuminate\Http\JsonResponse;

/**
 * Class for all admins action.
 */
class AllAdminsAction extends MainAction
{
    /**
     * 获取所有当前平台的商户管理员用户
     *
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(): JsonResponse
    {
        $data   = $this->currentPlatformEloq->adminUsers->toArray();
        $msgOut = msgOut($data);
        return $msgOut;
    }
}
