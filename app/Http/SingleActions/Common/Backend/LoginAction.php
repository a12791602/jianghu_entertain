<?php

namespace App\Http\SingleActions\Common\Backend;

use App\Http\Controllers\BackendApi\Headquarters\BackendAuthController;
use App\Models\Systems\BackendLoginLog;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Tymon\JWTAuth\Facades\JWTAuth;

/**
 * Class for backend auth login action.
 */
class LoginAction
{
    use AuthenticatesUsers;

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
     * @param  BackendAuthController $contll  Controller.
     * @param  Request               $request Request.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(BackendAuthController $contll, Request $request): JsonResponse
    {
        $request->validate(
            [
                'email'       => 'required|string|email',
                'password'    => 'required|string',
                'remember_me' => 'boolean',
            ],
        );
        $credentials = request(['email', 'password']);
        $token       = $contll->currentAuth->attempt($credentials);
        if (!$token) {
            throw new \Exception('100002');
        }
        if ($request->hasSession()) {
            $request->session()->regenerate();
            $this->clearLoginAttempts($request);
        }

        $this->incrementLoginAttempts($request);
        $expireInMinute = $contll->currentAuth->factory()->getTTL();
        $expireAt       = Carbon::now()->addMinutes($expireInMinute)->format('Y-m-d H:i:s');
        $user           = $contll->currentAuth->user();
        if ($user->remember_token !== null) {
            try {
                JWTAuth::setToken($user->remember_token);
                JWTAuth::invalidate();
            } catch (\Throwable $e) {
                Log::info($e->getMessage());
            }
        }
        $user->remember_token = $token;
        $user->save();

        $backendLoginLog = new BackendLoginLog();
        $backendLoginLog->insertData($user, $request, BackendLoginLog::TYPE_HEADQUARTERS);

        $data = [
            'access_token' => $token,
            'token_type'   => 'Bearer',
            'expires_at'   => $expireAt,
        ];
        $msgOut = msgOut(true, $data);
        return $msgOut;
    }
}
