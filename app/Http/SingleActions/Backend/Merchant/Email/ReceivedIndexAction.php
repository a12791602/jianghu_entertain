<?php

namespace App\Http\SingleActions\Backend\Merchant\Email;

use App\Http\Resources\Backend\Merchant\Email\ReceivedIndexResource;
use App\ModelFilters\Email\SystemEmailOfMerchantFilter;
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
        $systemEmailOfMerchant = new SystemEmailOfMerchant();
        if (isset($inputDatas['pageSize'])) {
            $systemEmailOfMerchant->setPerPage($inputDatas['pageSize']);
        }
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
            ->filter($inputDatas, SystemEmailOfMerchantFilter::class)
            ->with('email.headquarters')
            ->orderByDesc('created_at')
            ->paginate();
        return msgOut(ReceivedIndexResource::collection($emails));
    }
}
