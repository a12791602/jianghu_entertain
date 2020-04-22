<?php

namespace App\Http\SingleActions\Common\MerchantAuth;

use App\Http\Resources\Backend\Merchant\Auth\LoginResource;
use App\Http\SingleActions\MainAction;
use App\Models\Admin\MerchantAdminUser;
use App\Models\Systems\BackendLoginLog;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Tymon\JWTAuth\Facades\JWTAuth;

/**
 * Class for login action.
 */
class LoginAction extends MainAction
{
    use AuthenticatesUsers;

    /**
     * Get the maximum number of attempts to allow.
     *
     * @return integer
     */
    public function maxAttempts(): int
    {
        return config('auth.max_attempts');
    }

    /**
     * Login user and create token
     *
     * @param Request $request Request.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(Request $request): JsonResponse
    {
        $request->validate(
            [
             'email'       => 'required|string|email',
             'password'    => 'required|string',
             'remember_me' => 'boolean',
            ],
        );
        $credentials = request(['email', 'password']);
        $token       = $this->auth->attempt($credentials);
        if (!$token) {
            throw new \Exception('200401');
        }
        if ($request->hasSession()) {
            $request->session()->regenerate();
            $this->clearLoginAttempts($request);
        }

        $this->incrementLoginAttempts($request);
        $user = $this->auth->user();
        if ($user->status === MerchantAdminUser::STATUS_CLOSE) {
            throw new \Exception('200402');
        }
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
        $backendLoginLog->insertData($user, $request, BackendLoginLog::TYPE_MERCHANT);
        return msgOut(LoginResource::make($user));
    }
}
