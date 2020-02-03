<?php

namespace App\Http\SingleActions\Frontend\Common\FrontendAuth;

use App\Http\SingleActions\MainAction;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

/**
 * Class for frontend auth logout action.
 */
class LogoutAction extends MainAction
{
    use AuthenticatesUsers;

    /**
     * Login user and create token
     * @param Request $request Request.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(Request $request): JsonResponse
    {
        $throttleKey = Str::lower($this->username() . '|' . $request->ip());
        if ($request->hasSession()) {
            $request->session()->invalidate();
        }
        $this->limiter()->clear($throttleKey);
        $this->auth->logout();
        $this->auth->invalidate();
        $msgOut = msgOut(); //'Successfully logged out'
        return $msgOut;
    }
}
