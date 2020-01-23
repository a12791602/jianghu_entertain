<?php

namespace App\Http\SingleActions\Common\FrontendAuth;

use App\Events\FrontendLoginEvent;
use App\Http\Controllers\FrontendApi\FrontendApiMainController;
use App\Http\Requests\Frontend\Common\LoginVerificationRequest;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Tymon\JWTAuth\Facades\JWTAuth;

/**
 * Class for login action.
 */
class LoginAction
{
    use AuthenticatesUsers;

    /**
     * Agent
     *
     * @var object $userAgent
     */
    protected $userAgent;

    /**
     * Get the maximum number of attempts to allow.
     *
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
     * @param FrontendApiMainController $contll  Controller.
     * @param LoginVerificationRequest  $request Request.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(
        FrontendApiMainController $contll,
        LoginVerificationRequest $request
    ): JsonResponse {
        $this->userAgent = $contll->userAgent;
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->sendLockoutResponse($request);
        }
        $credentials = request(['mobile', 'password']);
        $token       = $contll->currentAuth->attempt($credentials);
        if (!$token) {
            $this->incrementLoginAttempts($request);
            throw new \Exception('100002');
        }
        if ($contll->currentAuth->user()->frozen_type === 1) {
            throw new \Exception('100014');
        }
        if ($request->hasSession()) {
            $request->session()->regenerate();
            $this->clearLoginAttempts($request);
        }
        $expireInMinute = $contll->currentAuth->factory()->getTTL();
        $expireAt       = Carbon::now()->addMinutes($expireInMinute)->format('Y-m-d H:i:s');
        $user           = $contll->currentAuth->user();
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
        $data = [
                 'access_token' => $token,
                 'token_type'   => 'Bearer',
                 'expires_at'   => $expireAt,
                ];
        event(new FrontendLoginEvent($user));
        $result = msgOut($data);
        return $result;
    }

    /**
     * @param Request $request Request.
     * @return string|null
     */
    protected function throttleKey(Request $request): ?string
    {
        if ($this->userAgent->isDesktop()) {
            $return = Str::lower($request->input($this->username())) . '|Desktop|' . $request->ip();
        } else {
            $return = Str::lower($request->input($this->username())) .
                '|' . $this->userAgent->device() .
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
