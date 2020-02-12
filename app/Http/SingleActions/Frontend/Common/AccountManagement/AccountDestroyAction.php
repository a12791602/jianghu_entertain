<?php

namespace App\Http\SingleActions\Frontend\Common\AccountManagement;

use App\Http\Requests\Frontend\Common\FrontendUser\AccountDestroyRequest;
use App\Http\SingleActions\MainAction;
use Illuminate\Http\JsonResponse;

/**
 * Class AccountDestroyAction
 * @package App\Http\SingleActions\Frontend\Common\AccountManagement
 */
class AccountDestroyAction extends MainAction
{
    /**
     * Destroy user account.
     * @param AccountDestroyRequest $request AccountDestroyRequest.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(AccountDestroyRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $item      = $this->user->bankCard()->where('id', $validated['card_id'])->delete();
        if (!$item) {
            throw new \Exception('100902');
        }
        $result = msgOut([], '100901');
        return $result;
    }
}
