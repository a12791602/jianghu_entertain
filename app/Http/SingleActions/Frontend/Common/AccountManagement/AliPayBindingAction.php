<?php

namespace App\Http\SingleActions\Frontend\Common\AccountManagement;

use App\Http\Requests\Frontend\Common\FrontendUser\AliPayBindingRequest;
use App\Http\Requests\Frontend\Common\FrontendUser\AliPayFirstBindingRequest;
use App\Http\SingleActions\MainAction;
use App\Models\User\FrontendUsersBankCard;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;

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
        $result = msgOut([], '100900');
        return $result;
    }

    /**
     * First binding AliPay.
     * @param AliPayFirstBindingRequest $request AliPayFirstBindingRequest.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function firstExecute(AliPayFirstBindingRequest $request): JsonResponse
    {
        $validated                 = $request->validated();
        $item                      = Arr::only($validated, ['card_number', 'owner_name']);
        $item['status']            = FrontendUsersBankCard::STATUS_OPEN;
        $item['type']              = FrontendUsersBankCard::TYPE_ALIPAY;
        $item['code']              = FrontendUsersBankCard::CODE_ALIPAY;
        $item['platform_sign']     = $this->currentPlatformEloq->sign;
        $this->user->fund_password = Hash::make($validated['fund_password']);
        $this->user->save();
        $this->user->bankCard()->create($item);
        $result = msgOut([], '100900');
        return $result;
    }
}
