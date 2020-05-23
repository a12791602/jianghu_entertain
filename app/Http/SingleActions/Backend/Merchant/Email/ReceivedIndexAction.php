<?php

namespace App\Http\SingleActions\Backend\Merchant\Email;

use App\Http\Resources\Backend\Merchant\Email\ReceivedIndexResource;
use App\Models\Email\SystemEmailOfMerchant;
use App\Models\Notification\MerchantNotificationStatistic;
use Illuminate\Http\JsonResponse;

/**
 * Class ReceivedIndexAction
 * @package App\Http\SingleActions\Backend\Merchant\Email
 */
class ReceivedIndexAction extends BaseAction
{
    /**
     * @param array $inputDatas InputDatas.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(array $inputDatas): JsonResponse
    {
        merchantNotificationClear(MerchantNotificationStatistic::EMAIL);
        $systemEmailOfMerchant       = new SystemEmailOfMerchant();
        $inputDatas['platform_sign'] = $this->currentPlatformEloq->sign;
        $emails                      = $systemEmailOfMerchant
            ->select(
                [
                 'id',
                 'email_id',
                 'merchant_id',
                 'is_read',
                 'created_at',
                ],
            )
            ->filter($inputDatas)
            ->where('merchant_id', $this->user->id)
            ->with('email.headquarters')
            ->orderByDesc('created_at')
            ->paginate($this->perPage);
        return msgOut(ReceivedIndexResource::collection($emails));
    }
}
