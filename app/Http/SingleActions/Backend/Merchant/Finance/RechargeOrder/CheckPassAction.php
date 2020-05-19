<?php

namespace App\Http\SingleActions\Backend\Merchant\Finance\RechargeOrder;

use App\Events\FrontendDynamicInfoEvent;
use App\Events\FrontendNoticeEvent;
use App\Http\Resources\Frontend\FrontendUser\DynamicInformationResource;
use App\Lib\Constant\JHHYCnst;
use App\Models\Finance\SystemFinanceType;
use App\Models\Order\UsersRechargeOrder;
use App\Models\User\FrontendUser;
use App\Models\User\FrontendUsersAccount;
use DB;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

/**
 * Class CheckPassAction
 * @package App\Http\SingleActions\Backend\Merchant\Finance\RechargeOrder
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
        $order = $this->model::find($inputDatas['id']);
        if (!$order instanceof UsersRechargeOrder) {
            throw new \Exception('202300');
        }
        if ($order->is_online !== SystemFinanceType::IS_ONLINE_NO) {
            throw new \Exception('202300');
        }
        if ($order->status !== UsersRechargeOrder::STATUS_CONFIRM) {
            throw new \Exception('202303');
        }
        DB::beginTransaction();
        try {
            $order->status   = UsersRechargeOrder::STATUS_SUCCESS;
            $order->admin_id = $this->user->id;
            $order->save();
            if (!$order->user instanceof FrontendUser || !$order->user->account instanceof FrontendUsersAccount) {
                throw new \Exception('202304');
            }
            $param = [
                      'user_id' => $order->user->id,
                      'amount'  => $order->arrive_money,
                     ];

            $notice_guid    = $order->user->guid;
            $notice_type    = JHHYCnst::NOTICE_OF_BALANCE_UPDATE;
            $notice_balance = ['balance' => $order->user->account->balance];
            $order->user->account->operateAccount('recharge', $param);
            broadcast(new FrontendNoticeEvent($notice_guid, $notice_type, '', $notice_balance));
            $user_info = DynamicInformationResource::make($order->user)->toArray(request());
            broadcast(new FrontendDynamicInfoEvent($order->user->guid, $user_info));
            return msgOut();
        } catch (\RuntimeException $exception) {
            $data    = [
                        'file'    => $exception->getFile(),
                        'line'    => $exception->getLine(),
                        'message' => $exception->getMessage(),
                       ];
            $logData = [
                        'orderNo' => $order->order_no ?? '',
                        'msg'     => '审核通过失败!',
                        'data'    => $data,
                       ];
            Log::channel('finance-callback-system')->info((string) json_encode($logData));
        }//end try
        DB::commit();
        throw new \Exception('202304');
    }
}
