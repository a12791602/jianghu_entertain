<?php

namespace App\Http\SingleActions\Backend\Merchant\Finance\WithdrawOrder;

use App\Models\User\FrontendUsersAudit;
use Illuminate\Http\JsonResponse;

/**
 * Class AuditAction
 * @package App\Http\SingleActions\Backend\Merchant\Finance\WithdrawOrder
 */
class AuditAction extends BaseAction
{
    /**
     * @param array $inputData InputData.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(array $inputData): JsonResponse
    {
        $audit = new FrontendUsersAudit();
        $item  = $audit->filter($inputData)->paginate($this->perPage);
        return msgOut($item);
    }
}
