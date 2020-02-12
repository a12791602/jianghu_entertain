<?php

namespace App\Http\SingleActions\Frontend\Common\AccountManagement;

use App\Http\Requests\Frontend\Common\FrontendUser\BankCardSaveRequest;
use App\Http\SingleActions\MainAction;
use App\Models\User\FrontendUsersBankCard;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;

/**
 * Class BankCardSaveAction
 * @package App\Http\SingleActions\Frontend\Common\AccountManagement
 */
class BankCardSaveAction extends MainAction
{
    /**
     * Save user account information.
     * @param BankCardSaveRequest $request BankCardAddRequest.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(BankCardSaveRequest $request): JsonResponse
    {
        $validated                 = $request->validated();
        $item                      = Arr::only($validated, ['branch', 'owner_name', 'card_number', 'code', 'bank_id']);
        $item['type']              = FrontendUsersBankCard::TYPE_DEBIT;
        $item['status']            = FrontendUsersBankCard::STATUS_OPEN;
        $item['platform_sign']     = $this->currentPlatformEloq->sign;
        $this->user->fund_password = Hash::make($validated['fund_password']);
        $this->user->save();
        $this->user->bankCard()->create($item);
        $result = msgOut([], '100900');
        return $result;
    }
}
