<?php

namespace App\Http\SingleActions\Backend\Merchant\Email;

use App\ModelFilters\Email\SystemEmailOfMerchantFilter;
use App\Models\Email\SystemEmailOfMerchant;
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
        $pageSize                    = SystemEmailOfMerchant::getPageSize();
        $inputDatas['platform_sign'] = $this->currentPlatformEloq->sign;
        $datas                       = SystemEmailOfMerchant::with('email:id,title,content')
            ->filter($inputDatas, SystemEmailOfMerchantFilter::class)
            ->orderByDesc('created_at')
            ->paginate($pageSize);
        $msgOut                      = msgOut($datas);
        return $msgOut;
    }
}
