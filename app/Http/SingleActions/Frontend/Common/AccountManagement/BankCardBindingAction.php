<?php

namespace App\Http\SingleActions\Frontend\Common\AccountManagement;

use App\Http\Requests\Frontend\Common\FrontendUser\BankCardBindingRequest;
use App\Http\Requests\Frontend\Common\FrontendUser\BankCardFirstBindingRequest;
use App\Http\SingleActions\MainAction;
use App\Models\User\FrontendUsersBankCard;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;

/**
 * Class BankCardBindingAction
 * @package App\Http\SingleActions\Frontend\Common\AccountManagement
 */
class BankCardBindingAction extends MainAction
{
    /**
     * Binding bank card.
     * @param BankCardBindingRequest $request BankCardBindingRequest.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(BankCardBindingRequest $request): JsonResponse
    {
        $item                  = $request->validated();
        $item['type']          = FrontendUsersBankCard::TYPE_DEBIT;
        $item['status']        = FrontendUsersBankCard::STATUS_OPEN;
        $item['platform_sign'] = $this->currentPlatformEloq->sign;
        $this->user->bankCard()->create($item);
        return msgOut([], '100900');
    }

    /**
     * First binding bank card.
     * @param BankCardFirstBindingRequest $request BankCardAddRequest.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function firstExecute(BankCardFirstBindingRequest $request): JsonResponse
    {
        $validated                 = $request->validated();
        $item                      = Arr::only($validated, ['branch', 'owner_name', 'card_number', 'code', 'bank_id']);
        $item['type']              = FrontendUsersBankCard::TYPE_DEBIT;
        $item['status']            = FrontendUsersBankCard::STATUS_OPEN;
        $item['platform_sign']     = $this->currentPlatformEloq->sign;
        $this->user->fund_password = Hash::make($validated['fund_password']);
        $this->user->save();
        $this->user->bankCard()->create($item);
        return msgOut([], '100900');
    }
}
