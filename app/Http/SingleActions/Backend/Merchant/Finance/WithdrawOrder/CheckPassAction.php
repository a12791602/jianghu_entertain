<?php

namespace App\Http\SingleActions\Backend\Merchant\Finance\WithdrawOrder;

use App\Models\User\UsersWithdrawOrder;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;

/**
 * Class CheckPassAction
 * @package App\Http\SingleActions\Backend\Merchant\Finance\WithdrawOrder
 */
class CheckPassAction extends BaseAction
{
    /**
     * @param array $inputDatas InputDatas.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(array $inputDatas): JsonResponse
    {
        $whereCondition = [
                           'id'     => $inputDatas['id'],
                           'status' => UsersWithdrawOrder::STATUS_CHECK_INIT,
                          ];
        $update         = [
                           'status'      => UsersWithdrawOrder::STATUS_CHECK_PASS,
                           'remark'      => $inputDatas['remark'] ?? null,
                           'reviewer_id' => $this->user->id,
                           'review_at'   => Carbon::now(),
                          ];
        $resl           = $this->model::where($whereCondition)->update($update);
        if ($resl) {
            return msgOut();
        }
        throw new \Exception('202900');
    }
}
