<?php

namespace App\Http\SingleActions\Common\FrontendAuth;

use App\Http\Controllers\FrontendApi\FrontendApiMainController;
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
     * Frontend registration action.
     * @param FrontendApiMainController $controller FrontendApiMainController.
     * @param RegisterRequest           $request    RegisterRequest.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(FrontendApiMainController $controller, RegisterRequest $request): JsonResponse
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
            'invite_code' => $request['invite_code'],
            'register_ip' => $request->ip(),
            'platform_id' => $controller->currentPlatformEloq->id,
            'platform_sign' => $controller->currentPlatformEloq->sign,
        ];
        FrontendUser::create($item);

        Cache::forget($verification_key);
        $result = msgOut(true);
        return $result;
    }
}
