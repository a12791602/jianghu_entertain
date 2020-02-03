<?php

namespace App\Http\SingleActions\Frontend\Common\AccountManagement;

use App\Http\Requests\Frontend\Common\FrontendUser\AliPaySaveRequest;
use App\Http\SingleActions\MainAction;
use App\Models\User\FrontendUsersBankCard;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Arr;

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
        $item                  = Arr::only($validated, ['card_number', 'owner_name', 'code', 'type']);
        $item['platform_sign'] = $this->currentPlatformEloq->sign;
        $item['status']        = FrontendUsersBankCard::STATUS_OPEN;
        $this->user->bankCard()->create($item);
        $result = msgOut();
        return $result;
    }
}
