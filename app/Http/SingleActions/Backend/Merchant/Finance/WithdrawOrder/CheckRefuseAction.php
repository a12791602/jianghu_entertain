<?php

namespace App\Http\SingleActions\Backend\Merchant\Finance\WithdrawOrder;

use App\Models\User\FrontendUser;
use App\Models\User\FrontendUsersAccount;
use App\Models\User\FrontendUsersWithdrawOrder;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Log;

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
                           'status' => FrontendUsersWithdrawOrder::STATUS_CHECK_INIT,
                          ];
        $update         = [
                           'status'      => FrontendUsersWithdrawOrder::STATUS_CHECK_REFUSE,
                           'remark'      => $inputDatas['remark'] ?? null,
                           'reviewer_id' => $this->user->id,
                           'review_at'   => Carbon::now(),
                          ];
        $withdrawOrder  = $this->model::find($inputDatas['id']);
        if (!$withdrawOrder instanceof FrontendUsersWithdrawOrder) {
            throw new \Exception('202904');
        }
        if (!$withdrawOrder->user instanceof FrontendUser) {
            throw new \Exception('202905');
        }
        if (!$withdrawOrder->user->account instanceof FrontendUsersAccount) {
            throw new \Exception('202906');
        }
        try {
            $result = $this->model::where($whereCondition)->update($update);
            if ($result) {
                $param = [
                          'user_id' => $withdrawOrder->user->id,
                          'amount'  => $withdrawOrder->amount,
                         ];
                $withdrawOrder->user->account->operateAccount('withdraw_un_frozen', $param);
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
                        'msg'     => '审核拒绝失败!',
                        'data'    => $data,
                       ];
            Log::channel('finance-callback-system')->info((string) json_encode($logData));
        }//end try
        throw new \Exception('202901');
    }
}
