<?php

namespace App\Http\SingleActions\Frontend\Common\AccountManagement;

use App\Http\Resources\Frontend\AccountManagement\AccountListResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class AccountListAction
 * @package App\Http\SingleActions\Common\FrontendUser
 */
class AccountListAction
{
    /**
     * Get user bank list.
     * @param Request $request Request.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(Request $request): JsonResponse
    {
        $user   = $request->user();
        $card   = $user->bankCard;
        $result = msgOut(AccountListResource::collection($card));
        return $result;
    }
}
