<?php

namespace App\Http\SingleActions\Frontend\Common\FrontendAuth;

use App\Http\Requests\Frontend\Common\LoginVerificationRequest;
use App\Http\SingleActions\MainAction;
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
     * Get the maximum number of attempts to allow.
     * @return integer
     */
    public function maxAttempts(): int
    {
        $attempt = config('auth.max_attempts');
        return $attempt;
    }

    /**
     * Login user and create token
     *
     * @param LoginVerificationRequest $request Request.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(LoginVerificationRequest $request): JsonResponse
    {
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->sendLockoutResponse($request);
        }
        $validated   = $request->validated();
        $credentials = Arr::only($validated, ['mobile', 'password']);

        $credentials['platform_sign'] = $this->currentPlatformEloq->sign;

        $token = $this->auth->attempt($credentials);
        if (!$token) {
            $this->incrementLoginAttempts($request);
            throw new \Exception('100002');
        }
        if ($this->auth->user()->frozen_type === 1) {
            throw new \Exception('100014');
        }
        if ($request->hasSession()) {
            $request->session()->regenerate();
            $this->clearLoginAttempts($request);
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
        $user->save();
        $data   = [
                   'access_token' => $token,
                   'token_type'   => 'Bearer',
                   'expires_at'   => $expireAt,
                  ];
        $result = msgOut($data);
        return $result;
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
}