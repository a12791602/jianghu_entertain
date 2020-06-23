<?php

namespace App\Http\SingleActions\Frontend\Common\FrontendAuth;

use App\Http\SingleActions\MainAction;
use Cache;
use Hash;
use Illuminate\Http\JsonResponse;

/**
 * Class SecurityCodeAction
 * @package App\Http\SingleActions\Common\FrontendAuth
 */
class SecurityCodeAction extends MainAction
{

    /**
     * Change front-end user security code.
     * @param array $request SecurityCodeRequest.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(array $request): JsonResponse
    {
        $verification_key = $request['verification_key'];
        $verifyData       = Cache::get($verification_key);
        if (!Hash::check($request['fund_password_old'], $this->user->fund_password)) {
            throw new \Exception('102003');
        }
        if (!$verifyData) {
            throw new \Exception('100502');
        }
        if (!hash_equals($verifyData['verification_code'], $request['verification_code'])) {
            throw new \Exception('100503', 401);
        }
        $this->user->fund_password = bcrypt($request['fund_password']);
        $this->user->save();
        Cache::forget($verification_key);
        return msgOut();
    }
}
