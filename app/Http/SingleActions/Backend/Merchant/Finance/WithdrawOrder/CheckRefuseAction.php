<?php

namespace App\Http\SingleActions\Backend\Merchant\Finance\WithdrawOrder;

use App\Models\User\UsersWithdrawOrder;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/**
 * Class CheckRefuseAction
 * @package App\Http\SingleActions\Backend\Merchant\Finance\WithdrawOrder
 */
class CheckRefuseAction extends BaseAction
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
                           'status'      => UsersWithdrawOrder::STATUS_CHECK_REFUSE,
                           'remark'      => $inputDatas['remark'] ?? null,
                           'reviewer_id' => $this->user->id,
                           'review_at'   => Carbon::now(),
                          ];
        $withdrawOrder  = $this->model::find($inputDatas['id']);
        DB::beginTransaction();
        try {
            $resl = $this->model::where($whereCondition)->update($update);
            if ($resl) {
                $withdrawOrder->user->account->operateAccount(
                    ['amount' => $withdrawOrder->amount],
                    'withdraw_un_frozen',
                );
                DB::commit();
                $msgOut = msgOut();
                return $msgOut;
            }
        } catch (\Throwable $exception) {
            $data    = [
                        'file'    => $exception->getFile(),
                        'line'    => $exception->getLine(),
                        'message' => $exception->getMessage(),
                       ];
            $logData = [
                        'orderNo' => $withdrawOrder->order_no,
                        'msg'     => '审核拒绝失败!',
                        'data'    => $data,
                       ];
            Log::channel('finance-callback-system')->info(json_encode($logData));
        }
        DB::rollBack();
        throw new \Exception('202901');
    }
}
