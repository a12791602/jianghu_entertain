<?php

namespace App\Http\SingleActions\Frontend\Common\AccountManagement;

use App\Http\Controllers\FrontendApi\FrontendApiMainController;
use App\Http\Requests\Frontend\Common\FrontendUser\AliPaySaveRequest;
use App\Models\User\FrontendUsersBankCard;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Arr;

/**
 * Class AliPaySaveAction
 * @package App\Http\SingleActions\Frontend\Common\AccountManagement
 */
class AliPaySaveAction
{
    /**
     * Save user account information.
     * @param FrontendApiMainController $controller FrontendApiMainController.
     * @param AliPaySaveRequest         $request    AliPayAddRequest.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(
        FrontendApiMainController $controller,
        AliPaySaveRequest $request
    ): JsonResponse {
        $validated             = $request->validated();
        $item                  = Arr::only($validated, ['card_number', 'owner_name', 'code', 'type']);
        $item['platform_sign'] = $controller->currentPlatformEloq->sign;
        $item['status']        = FrontendUsersBankCard::STATUS_OPEN;
        $user                  = $request->user();
        $user->bankCard()->create($item);
        $result = msgOut();
        return $result;
    }
}
