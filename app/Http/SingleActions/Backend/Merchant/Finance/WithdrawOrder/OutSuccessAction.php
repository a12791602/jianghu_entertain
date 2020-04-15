<?php

namespace App\Http\SingleActions\Backend\Merchant\Finance\WithdrawOrder;

use App\Models\User\UsersWithdrawOrder;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
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
        if (!$withdrawOrder || !$withdrawOrder->user || !$withdrawOrder->user->account) {
            throw new \Exception('202902');
        }
        try {
            $result = $this->model::where($whereCondition)->update($update);
            if ($result) {
                $param = [
                          'user_id' => $this->user->id,
                          'amount'  => $withdrawOrder->amount,
                         ];
                $withdrawOrder->user->account->operateAccount('withdraw_finish', $param);
                return msgOut();
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
            Log::channel('finance-callback-system')->info((string) json_encode($logData));
        }
        throw new \Exception('202902');
    }
}
