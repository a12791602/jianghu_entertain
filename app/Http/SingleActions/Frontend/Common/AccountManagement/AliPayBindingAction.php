<?php

namespace App\Http\SingleActions\Frontend\Common\AccountManagement;

use App\Http\Requests\Frontend\Common\FrontendUser\AliPayBindingRequest;
use App\Http\SingleActions\MainAction;
use App\Models\User\FrontendUsersBankCard;
use Illuminate\Http\JsonResponse;

/**
 * Class AliPayBindingAction
 * @package App\Http\SingleActions\Frontend\Common\AccountManagement
 */
class AliPayBindingAction extends MainAction
{

    /**
     * Binding AliPay.
     * @param AliPayBindingRequest $request AliPayAddRequest.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(AliPayBindingRequest $request): JsonResponse
    {
        $item                  = $request->validated();
        $item['status']        = FrontendUsersBankCard::STATUS_OPEN;
        $item['type']          = FrontendUsersBankCard::TYPE_ALIPAY;
        $item['code']          = FrontendUsersBankCard::CODE_ALIPAY;
        $item['platform_sign'] = $this->currentPlatformEloq->sign;
        $this->user->bankCard()->create($item);
        return msgOut([], '100900');
    }
}
