<?php

namespace App\Http\SingleActions\Frontend\Common\FrontendAuth;

use App\Http\Requests\Frontend\Common\LoginVerificationRequest;
use App\Http\SingleActions\MainAction;
use App\Models\User\FrontendUser;
use Cache;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Tymon\JWTAuth\Facades\JWTAuth;

/**
 * Class for login action.
 */
class LoginAction extends MainAction
{
    use AuthenticatesUsers;

    /**
     * Login user and create token
     *
     * @param LoginVerificationRequest $request Request.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(LoginVerificationRequest $request): JsonResponse
    {
        $validated     = $request->validated();
        $platform_sign = $this->currentPlatformEloq->sign;
        $mobile        = $validated['mobile'];
        //Login attempts to cache prefix.
        $login_attempt_prefix = $platform_sign . ':frontend_user_' . $mobile;
        $login_error_num      = (int) configure($platform_sign, 'login_error_num');
        if ((int) Cache::get($login_attempt_prefix) >= $login_error_num) {
            $this->disableAccount($platform_sign, $mobile);
            throw new \Exception('203250', 429);
        }
        $credentials                  = Arr::only($validated, ['mobile', 'password']);
        $credentials['platform_sign'] = $platform_sign;
        $token                        = $this->auth->attempt($credentials);
        if (!$token) {
            Cache::increment($login_attempt_prefix);
            throw new \Exception('100002');
        }
        Cache::delete($login_attempt_prefix);
        if ($this->auth->user()->frozen_type === 1) {
            throw new \Exception('100014');
        }
        $expireInMinute = $this->auth->factory()->getTTL();
        $expireAt       = Carbon::now()->addMinutes($expireInMinute)->format('Y-m-d H:i:s');
        $user           = $this->auth->user();
        if ($user->remember_token !== null) {
            try {
                JWTAuth::setToken($user->remember_token);
                JWTAuth::invalidate();
            } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
                Log::info($e->getMessage());
            }
        }
        $user->remember_token  = $token;
        $user->last_login_ip   = request()->ip();
        $user->last_login_time = Carbon::now()->timestamp;
        $user->is_online       = 1;
        $user->save();
        $data = [
                 'access_token' => $token,
                 'token_type'   => 'Bearer',
                 'expires_at'   => $expireAt,
                ];
        return msgOut($data);
    }

    /**
     * @param Request $request Request.
     * @return string|null
     */
    protected function throttleKey(Request $request): ?string
    {
        if ($this->agent->isDesktop()) {
            $return = Str::lower($request->input($this->username())) . '|Desktop|' . $request->ip();
        } else {
            $return = Str::lower($request->input($this->username())) .
                '|' . $this->agent->device() .
                '|' . $request->ip();
        }
        return $return;
    }

    /**
     * @return string
     */
    protected function username(): string
    {
        return 'mobile';
    }

    /**
     * Disable account.
     * @param string $platform_sign Platform_sign.
     * @param string $mobile        Mobile.
     * @return void
     */
    protected function disableAccount(string $platform_sign, string $mobile): void
    {
        $condition = [
                      'platform_sign' => $platform_sign,
                      'mobile'        => $mobile,
                     ];
        FrontendUser::where($condition)->update(['status' => FrontendUser::STATUS_DISABLE]);
    }
}
