<?php

namespace App\Http\SingleActions\Frontend\Common\AccountManagement;

use App\Http\Requests\Frontend\Common\FrontendUser\WithdrawRequest;
use App\Http\SingleActions\MainAction;
use Illuminate\Http\JsonResponse;

/**
 * Class AliPayBindingAction
 * @package App\Http\SingleActions\Frontend\Common\AccountManagement
 */
class WithdrawAction extends MainAction
{
    /**
     * Account withdraw.
     * @param WithdrawRequest $request WithdrawRequest.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(WithdrawRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $user      = $this->user;

        $item = [
                 'amount'         => $validated['amount'],
                 'platform_sign'  => $this->currentPlatformEloq->sign,
                 'bank_id'        => $validated['bank_id'],
                 'mobile'         => $user->mobile,
                 'before_balance' => $user->account->balance,
                ];
        $user->withdraw()->create($item);
        $result = msgOut([], '100903');
        return $result;
    }
}
