<?php

namespace App\Http\SingleActions\Frontend\Common\AccountManagement;

use App\Http\Requests\Frontend\Common\FrontendUser\BankCardBindingRequest;
use App\Http\SingleActions\MainAction;
use App\Models\User\FrontendUsersBankCard;
use Illuminate\Http\JsonResponse;

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
}
