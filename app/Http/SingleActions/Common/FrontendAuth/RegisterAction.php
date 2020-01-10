<?php

namespace App\Http\SingleActions\Common\FrontendAuth;

use App\Http\Requests\Frontend\Common\RegisterRequest;
use App\Models\User\FrontendUser;
use Cache;
use Illuminate\Http\JsonResponse;

/**
 * Class RegisterAction
 * @package App\Http\SingleActions\Common\FrontendAuth
 */
class RegisterAction
{

    /**
     * @param RegisterRequest $request RegisterRequest.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(RegisterRequest $request): JsonResponse
    {
        $verification_key = $request['verification_key'];
        $verifyData       = Cache::get($verification_key);
        if (!$verifyData) {
            throw new \Exception('100502');
        }
        if (!hash_equals($verifyData['verification_code'], $request['verification_code'])) {
            throw new \Exception('100503', 401);
        }
        $item = [
            'mobile' => $verifyData['mobile'],
            'username' => $verifyData['mobile'],
            'password' => bcrypt($request['password']),
            'register_ip' => $request->ip(),
        ];
        $user = FrontendUser::create($item);
        Cache::forget($verification_key);
        $result = msgOut(true, $user);
        return $result;
    }
}
