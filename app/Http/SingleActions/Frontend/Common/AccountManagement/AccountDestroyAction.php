<?php

namespace App\Http\SingleActions\Frontend\Common\AccountManagement;

use App\Http\Requests\Frontend\Common\FrontendUser\AccountDestroyRequest;
use App\Http\SingleActions\Frontend\Common\VerificationCode\VerificationCodeCheckAction;
use Cache;
use Illuminate\Http\JsonResponse;

/**
 * Class AccountDestroyAction
 * @package App\Http\SingleActions\Frontend\Common\AccountManagement
 */
class AccountDestroyAction extends VerificationCodeCheckAction
{

    /**
     * Destroy user account.
     * @param AccountDestroyRequest $request AccountDestroyRequest.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(AccountDestroyRequest $request): JsonResponse
    {
        $validated               = $request->validated();
        $verification_key        = $this->checkVerificationCode($validated);
        $condition               = [];
        $condition['id']         = $validated['card_id'];
        $condition['owner_name'] = $validated['owner_name'];
        $item                    = $this->user->bankCard()->where($condition)->delete();
        if (!$item) {
            throw new \Exception('100902');
        }
        Cache::forget($verification_key);
        return msgOut([], '100901');
    }
}
