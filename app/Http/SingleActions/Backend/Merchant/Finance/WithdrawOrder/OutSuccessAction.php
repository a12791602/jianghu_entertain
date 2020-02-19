<?php

namespace App\Http\SingleActions\Backend\Merchant\Finance\WithdrawOrder;

use App\Models\User\UsersWithdrawOrder;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/**
 * Class OutSuccessAction
 * @package App\Http\SingleActions\Backend\Merchant\Finance\WithdrawOrder
 */
class OutSuccessAction extends BaseAction
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
                           'status' => UsersWithdrawOrder::STATUS_CHECK_PASS,
                          ];
        $update         = [
                           'status'       => UsersWithdrawOrder::STATUS_OUT_SUCESS,
                           'remark'       => $inputDatas['remark'] ?? null,
                           'admin_id'     => $this->user->id,
                           'operation_at' => Carbon::now(),
                          ];
        $withdrawOrder  = $this->model::find($inputDatas['id']);
        DB::beginTransaction();
        try {
            $resl = $this->model::where($whereCondition)->update($update);
            if ($resl) {
                $withdrawOrder->user->account->operateAccount(
                    ['amount' => $withdrawOrder->amount],
                    'withdraw_finish',
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
                        'msg'     => '出款通过失败!',
                        'data'    => $data,
                       ];
            Log::channel('finance-callback-system')->info(json_encode($logData));
        }
        DB::rollBack();
        throw new \Exception('202902');
    }
}
