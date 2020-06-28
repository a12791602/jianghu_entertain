<?php

namespace App\Http\SingleActions\Frontend\Common\AccountManagement;

use App\Http\Requests\Frontend\Common\FrontendUser\BankCardBindingRequest;
use App\Http\SingleActions\MainAction;
use App\Models\User\FrontendUsersBankCard;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Redis;

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
        $platform_sign         = $this->currentPlatformEloq->sign;
        $item['platform_sign'] = $platform_sign;
        $bank_card_frozen      = (int) configure($platform_sign, 'bank_card_frozen') * 3600;
        $card                  = $this->user->bankCard()->create($item);
        $cache                 = Redis::connection();
        $cache_prefix          = $platform_sign . ':frontend_user_' . $this->user->id . ':binding_card:' . $card->id;
        $cache->set($cache_prefix, $card->id);
        $cache->expire($cache_prefix, $bank_card_frozen);
        return msgOut([], '100900');
    }
}
