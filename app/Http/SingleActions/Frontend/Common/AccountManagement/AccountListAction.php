<?php

namespace App\Http\SingleActions\Frontend\Common\AccountManagement;

use App\Http\Resources\Frontend\AccountManagement\AccountListResource;
use App\Http\SingleActions\MainAction;
use Illuminate\Http\JsonResponse;

/**
 * Class AccountListAction
 * @package App\Http\SingleActions\Common\FrontendUser
 */
class AccountListAction extends MainAction
{
    /**
     * Get user bank list.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(): JsonResponse
    {
        $card   = $this->user->bankCard->sortByDesc('created_at');
        $result = msgOut(AccountListResource::collection($card));
        return $result;
    }
}
