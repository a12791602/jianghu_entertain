<?php

namespace App\Http\SingleActions\Common\FrontendAuth;

use App\Http\Controllers\FrontendApi\FrontendApiMainController;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;


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
     * @var integer
     */
    protected $maxAttempts;

    /**
     * @var integer
     */
    protected $decayMinutes;

    /**
     * Login user and create token
     *
     * @param  FrontendApiMainController $contll  Controller.
     * @param  Request                   $request Request.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(FrontendApiMainController $contll, Request $request): JsonResponse
    {
        $this->userAgent = $contll->userAgent;
        $request->validate(
            [
            'username' => 'required|string|alpha_dash',
            'password' => 'required|string',
            'remember_me' => 'boolean',
            ],
        );
        $credentials = request(['username', 'password']);
        $this->maxAttempts = 1; //1 times
        $this->decayMinutes = 1; //1 minutes
        $token = $contll->currentAuth->attempt($credentials);
        if (!$token) {
            throw new \Exception('100002');
        }
        if ($contll->currentAuth->user()->frozen_type === 1) {
            throw new \Exception('100014');
        }
        if ($request->hasSession()) {
            $request->session()->regenerate();
            $this->clearLoginAttempts($request);
        }
        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);
        $expireInMinute = $contll->currentAuth->factory()->getTTL();
        $expireAt = Carbon::now()->addMinutes($expireInMinute)->format('Y-m-d H:i:s');
        $user = $contll->currentAuth->user();
        if ($user->remember_token !== null) {
            try {
                JWTAuth::setToken($user->remember_token);
                JWTAuth::invalidate();
            } catch (JWTException $e) {
                Log::info($e->getMessage());
            }
        }
        $user->remember_token = $token;
        $user->last_login_ip = request()->ip();
        $user->last_login_time = Carbon::now()->timestamp;
        $user->save();
        $data = [
            'access_token' => $token,
            'token_type' => 'Bearer',
            'expires_at' => $expireAt,
        ];
        return msgOut(true, $data);
    }

    /**
     * @param  Request $request Request.
     * @return string|null
     */
    protected function throttleKey(Request $request):  ? string
    {
        if ($this->userAgent->isDesktop()) {
            return Str::lower($request->input($this->username())) . '|Desktop|' . $request->ip();
        } else {
            return Str::lower($request->input($this->username())) .
            '|' . $this->userAgent->device() .
            '|' . $request->ip();
        }
    }

    /**
     * @return string
     */
    protected function username() : string
    {
        return 'username';
    }
}
