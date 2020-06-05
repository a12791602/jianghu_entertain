<?php

namespace App\Http\SingleActions\Backend\Merchant\Notification;

use App\Http\Resources\Backend\Merchant\Notification\IndexResource;
use App\Http\SingleActions\MainAction;
use App\Models\Email\SystemEmailOfMerchant;
use App\Models\Order\UsersRechargeOrder;
use App\Models\User\UsersWithdrawOrder;
use Illuminate\Http\JsonResponse;

/**
 * Class IndexAction
 * @package App\Http\SingleActions\Backend\Merchant\Notice\System
 */
class StatisticAction extends MainAction
{

    /**
     * ***
     * @return JsonResponse
     */
    public function execute(): JsonResponse
    {
        $condition = [];

        $condition['platform_id'] = $this->currentPlatformEloq->id;

        $email_condition = [
                            'is_read'     => SystemEmailOfMerchant::EMAIL_UNREAD,
                            'merchant_id' => $this->user->id,
                           ];

        $online_top_up_condition = [
                                    'status'    => UsersRechargeOrder::STATUS_INIT,
                                    'is_online' => UsersRechargeOrder::OFFLINE_FINANCE,
                                   ];

        $email             = SystemEmailOfMerchant::where($email_condition)->count();
        $offline_top_up    = UsersRechargeOrder::where($online_top_up_condition)->count();
        $withdrawal_order  = UsersWithdrawOrder::where('status', UsersWithdrawOrder::STATUS_CHECK_INIT)->count();
        $withdrawal_review = UsersWithdrawOrder::where('status', UsersWithdrawOrder::STATUS_CHECK_PASS)->count();

        $item = [
                 'email'             => $email,
                 'online_top_up'     => 0,
                 'offline_top_up'    => $offline_top_up,
                 'withdrawal_review' => $withdrawal_order,
                 'withdrawal_order'  => $withdrawal_review,
                ];
        return msgOut(IndexResource::make($item));
    }
}
