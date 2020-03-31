<?php

namespace App\Http\SingleActions\Frontend\Common\FrontendAuth;

use App\Http\Requests\Frontend\Common\ResetPasswordRequest;
use App\Models\User\FrontendUser;
use Cache;
use Illuminate\Http\JsonResponse;

/**
 * Class ResetPasswordAction
 * @package App\Http\SingleActions\Common\FrontendAuth
 */
class ResetPasswordAction
{

    /**
     * Reset frontend-user password.
     * @param ResetPasswordRequest $request ResetPasswordRequest.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(ResetPasswordRequest $request): JsonResponse
    {
        $verification_key = $request['verification_key'];
        $verifyData       = Cache::get($verification_key);
        if (!$verifyData) {
            throw new \Exception('100502');
        }
        if (!hash_equals($verifyData['verification_code'], $request['verification_code'])) {
            throw new \Exception('100503', 401);
        }

        FrontendUser::where('mobile', $verifyData['mobile'])->update(['password' => bcrypt($request['password'])]);
        Cache::forget($verification_key);
        return msgOut([], '102002');
    }
}
