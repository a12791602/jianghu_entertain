<?php

namespace App\Http\SingleActions\Frontend\Common\AccountManagement;

use App\Http\Requests\Frontend\Common\FrontendUser\AliPaySaveRequest;
use App\Http\SingleActions\MainAction;
use App\Models\User\FrontendUsersBankCard;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;

/**
 * Class AliPaySaveAction
 * @package App\Http\SingleActions\Frontend\Common\AccountManagement
 */
class AliPaySaveAction extends MainAction
{

    /**
     * Save user account information.
     * @param AliPaySaveRequest $request AliPayAddRequest.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(AliPaySaveRequest $request): JsonResponse
    {
        $validated             = $request->validated();
        $item                  = Arr::only($validated, ['card_number', 'owner_name']);
        $item['status']        = FrontendUsersBankCard::STATUS_OPEN;
        $item['type']          = FrontendUsersBankCard::TYPE_ALIPAY;
        $item['platform_sign'] = $this->currentPlatformEloq->sign;
        $user                  = $this->user;
        $user->fund_password   = Hash::make($validated['fund_password']);
        $user->save();
        $user->bankCard()->create($item);
        $result = msgOut([], '100900');
        return $result;
    }
}
