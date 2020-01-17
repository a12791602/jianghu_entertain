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
     * @param RegisterRequest           $request    Frontend RegisterRequest.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(FrontendApiMainController $controller, RegisterRequest $request): JsonResponse
    {
        $platform_sign    = $controller->currentPlatformEloq->sign;
        $redis            = app('redis_user_unique_id');
        $register_user_id = $redis->spop($platform_sign . '_' . config('web.main.frontend_user_unique_id'))[0];
        $verification_key = $request['verification_key'];
        $verifyData       = Cache::get($verification_key);
        if (!$verifyData) {
            throw new \Exception('100502');
        }
        if (!hash_equals($verifyData['verification_code'], $request['verification_code'])) {
            throw new \Exception('100503', 401);
        }
        $user = $this->user(
            $verifyData['mobile'],
            $register_user_id,
            bcrypt($request['password']),
            $request->post('invite_code', '0'),
            $request->ip(),
            $controller->currentPlatformEloq->id,
            $platform_sign,
        );
        $data = $this->token($controller, $user, $request);
        event(new FrontendLoginEvent($user));
        $result = msgOut($data);
        Cache::forget($verification_key);

        return $result;
    }

    /**
     * Generate token.
     * @param FrontendApiMainController $controller FrontendApiMainController.
     * @param FrontendUser              $user       Frontend User Model.
     * @param RegisterRequest           $request    Frontend RegisterRequest.
     * @return mixed[]
     */
    public function token(FrontendApiMainController $controller, FrontendUser $user, RegisterRequest $request): array
    {
        $token          = $controller->currentAuth->login($user);
        $expireInMinute = $controller->currentAuth->factory()->getTTL();
        $expireAt       = Carbon::now()->addMinutes($expireInMinute)->format('Y-m-d H:i:s');
        $user           = $controller->currentAuth->user();

        if ($user->remember_token !== null) {
            try {
                JWTAuth::setToken($user->remember_token);
                JWTAuth::invalidate();
            } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
                Log::info($e->getMessage());
            }
        }
        $user->remember_token  = $token;
        $user->last_login_ip   = $request->ip();
        $user->last_login_time = Carbon::now()->timestamp;
        $user->save();
        $result = [
                   'access_token' => $token,
                   'token_type'   => 'Bearer',
                   'expires_at'   => $expireAt,
                  ];

        return $result;
    }

    /**
     * Frontend User Model
     * @param string  $mobile      Mobile.
     * @param string  $user_id     User_id.
     * @param string  $password    Password.
     * @param string  $invite_code Invite_code.
     * @param string  $register_ip Register_ip.
     * @param integer $platform_id Platform_id.
     * @param string  $sign        Sign.
     * @return FrontendUser
     */
    public function user(
        string $mobile,
        string $user_id,
        string $password,
        string $invite_code,
        string $register_ip,
        int $platform_id,
        string $sign
    ): FrontendUser {
        $item = [
                 'mobile'        => $mobile,
                 'uid'           => $user_id,
                 'password'      => $password,
                 'invite_code'   => $invite_code,
                 'register_ip'   => $register_ip,
                 'platform_id'   => $platform_id,
                 'platform_sign' => $sign,
                ];

        $result = FrontendUser::create($item);
        return $result;
    }
}
