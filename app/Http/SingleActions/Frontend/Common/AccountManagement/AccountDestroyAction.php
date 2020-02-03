<?php

namespace App\Http\SingleActions\Frontend\Common\AccountManagement;

use App\Http\Requests\Frontend\Common\FrontendUser\AccountDestroyRequest;
use App\Http\SingleActions\MainAction;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Arr;

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
        $condition = Arr::only($validated, ['card_number', 'owner_name']);
        $item      = $this->user->bankCard()->where($condition)->delete();
        if (!$item) {
            throw new \Exception('100801');
        }
        $result = msgOut();
        return $result;
    }
}
