<?php

namespace App\Http\SingleActions\Frontend\Common\AccountManagement;

use App\Http\SingleActions\MainAction;
use Hash;
use Illuminate\Http\JsonResponse;

/**
 * Class FundPasswordAction
 * @package App\Http\SingleActions\Frontend\Common\AccountManagement
 */
class FundPasswordAction extends MainAction
{

    /**
     * @param array $request Request.
     * @return JsonResponse
     */
    public function execute(array $request): JsonResponse
    {
        $this->user->fund_password = Hash::make($request['fund_password']);
        $this->user->save();
        return msgOut();
    }
}
