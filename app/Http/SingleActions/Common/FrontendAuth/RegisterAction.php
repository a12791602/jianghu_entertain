<?php

namespace App\Http\SingleActions\Common\FrontendAuth;

use App\Events\FrontendLoginEvent;
use App\Http\Controllers\FrontendApi\FrontendApiMainController;
use App\Http\Requests\Frontend\Common\RegisterRequest;
use App\Models\User\FrontendUser;
use Cache;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

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
        $user = FrontendUser::create($item);

        $token          = $controller->currentAuth->login($user);
        $expireInMinute = $controller->currentAuth->factory()->getTTL();
        $expireAt       = Carbon::now()->addMinutes($expireInMinute)->format('Y-m-d H:i:s');
        $user           = $controller->currentAuth->user();
        
        if ($user->remember_token !== null) {
            try {
                JWTAuth::setToken($user->remember_token);
                JWTAuth::invalidate();
            } catch (JWTException $e) {
                Log::info($e->getMessage());
            }
        }
        $user->remember_token  = $token;
        $user->last_login_ip   = $request->ip();
        $user->last_login_time = Carbon::now()->timestamp;
        $user->save();
        $data = [
            'access_token' => $token,
            'token_type' => 'Bearer',
            'expires_at' => $expireAt,
        ];
        event(new FrontendLoginEvent($user));
        $result = msgOut(true, $data);
        Cache::forget($verification_key);
        return $result;
    }
}
