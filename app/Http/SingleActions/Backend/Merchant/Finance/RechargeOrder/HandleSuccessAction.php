<?php

namespace App\Http\SingleActions\Backend\Merchant\Finance\RechargeOrder;

use App\Models\Finance\SystemFinanceType;
use App\Models\User\FrontendUser;
use App\Models\User\FrontendUsersAccount;
use App\Models\User\UsersRechargeOrder;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/**
 * Class HandleSuccessAction
 * @package App\Http\SingleActions\Backend\Merchant\Finance\RechargeOrder
 */
class HandleSuccessAction extends BaseAction
{
    /**
     * @param array $inputDatas InputDatas.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(array $inputDatas): JsonResponse
    {
        $order = $this->model::find($inputDatas['id']);
        if (!$order instanceof $this->model) {
            throw new \Exception('202305');
        }
        if ($order->is_online !== SystemFinanceType::IS_ONLINE_YES) {
            throw new \Exception('202300');
        }
        if ($order->status !== UsersRechargeOrder::STATUS_INIT) {
            throw new \Exception('202301');
        }
        DB::beginTransaction();
        try {
            $order->status   = UsersRechargeOrder::STATUS_SUCCESS;
            $order->remark   = $inputDatas['remark'];
            $order->admin_id = $this->user->id;
            if ($order->save()) {
                $user = $order->user;
                if (!$user instanceof FrontendUser) {
                    throw new \Exception('100505');//用户不存在
                }
                $account = $user->account;
                if (!$account instanceof FrontendUsersAccount) {
                    throw new \Exception('203001');
                }
                $account->operateAccount(
                    'recharge',
                    ['amount' => $order->arrive_money],
                );
                DB::commit();
                return msgOut();
            }
        } catch (\Throwable $exception) {
            $data    = [
                        'file'    => $exception->getFile(),
                        'line'    => $exception->getLine(),
                        'message' => $exception->getMessage(),
                       ];
            $logData = [
                        'orderNo' => $order->order_no,
                        'msg'     => '手动入款失败!',
                        'data'    => $data,
                       ];
            Log::channel('finance-callback-system')->info((string) json_encode($logData));
        }//end try
        DB::rollBack();
        throw new \Exception('202302');
    }
}
