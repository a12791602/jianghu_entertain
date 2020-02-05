<?php

namespace App\Http\SingleActions\Backend\Merchant\Finance\RechargeOrder;

use App\Models\Finance\SystemFinanceType;
use App\Models\Order\UsersRechargeOrder;
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
        if ($order->is_online !== SystemFinanceType::IS_ONLINE_YES) {
            throw new \Exception('202300');
        }
        if ($order->status !== UsersRechargeOrder::STATUS_INIT) {
            throw new \Exception('202301');
        }
        DB::beginTransaction();
        try {
            $order->status = UsersRechargeOrder::STATUS_SUCCESS;
            if ($order->save()) {
                $order->user->account->operateAccount(
                    ['amount' => $order->arrive_money],
                    'recharge',
                );
                DB::commit();
                $msgOut = msgOut();
                return $msgOut;
            }
        } catch (\Throwable $exception) {
            $data = [
                     'file'    => $exception->getFile(),
                     'line'    => $exception->getLine(),
                     'message' => $exception->getMessage(),
                    ];
            Log::info(json_encode($data));
        }
        DB::rollBack();
        throw new \Exception('202302');
    }
}