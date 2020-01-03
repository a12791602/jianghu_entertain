<?php

namespace App\Http\SingleActions\Common\FrontendAuth;

use App\Http\Requests\Frontend\Common\SecurityCodeRequest;
use App\Models\User\FrontendUser;
use Cache;
use Illuminate\Http\JsonResponse;

/**
 * Class SecurityCodeAction
 * @package App\Http\SingleActions\Common\FrontendAuth
 */
class SecurityCodeAction
{

    /**
     * Change front-end user security code.
     * @param SecurityCodeRequest $request SecurityCodeRequest.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(SecurityCodeRequest $request): JsonResponse
    {
        $verification_key = $request['verification_key'];
        $verifyData       = Cache::get($verification_key);
        if (!$verifyData) {
            throw new \Exception('200002');
        }
        if (!hash_equals($verifyData['verification_code'], $request['verification_code'])) {
            throw new \Exception('200003', 401);
        }

        FrontendUser::where('mobile', $verifyData['mobile'])
            ->update(['security_code' => bcrypt($request['security_code'])]);
        Cache::forget($verification_key);
        $result = msgOut(true);
        return $result;
    }
}
