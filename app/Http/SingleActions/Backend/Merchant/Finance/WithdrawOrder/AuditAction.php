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
        if (isset($inputData['pageSize'])) {
            $audit->setPerPage($inputData['pageSize']);
        }
        $item = $audit->filter($inputData)->paginate();
        return msgOut($item);
    }
}
