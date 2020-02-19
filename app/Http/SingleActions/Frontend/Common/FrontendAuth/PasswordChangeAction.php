<?php

namespace App\Http\SingleActions\Frontend\Common\FrontendAuth;

use App\Http\Requests\Frontend\Common\PasswordChangeRequest;
use App\Http\SingleActions\MainAction;
use Cache;
use Illuminate\Http\JsonResponse;

/**
 * Class PasswordChangeAction
 * @package App\Http\SingleActions\Frontend\Common\FrontendAuth
 */
class PasswordChangeAction extends MainAction
{

    /**
     * Frontend-user change password.
     * @param PasswordChangeRequest $request PasswordChangeRequest.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(PasswordChangeRequest $request): JsonResponse
    {
        $verification_key = $request['verification_key'];
        $verifyData       = Cache::get($verification_key);
        if (!$verifyData) {
            throw new \Exception('100502');
        }
        if (!hash_equals($verifyData['verification_code'], $request['verification_code'])) {
            throw new \Exception('100503', 401);
        }

        $this->user->update(['password' => bcrypt($request['password'])]);
        Cache::forget($verification_key);
        $result = msgOut([], '102001');
        return $result;
    }
}
