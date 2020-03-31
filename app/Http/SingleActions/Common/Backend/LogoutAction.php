<?php

namespace App\Http\SingleActions\Common\Backend;

use App\Http\SingleActions\MainAction;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

/**
 * Class for backend auth logout action.
 */
class LogoutAction extends MainAction
{
    use AuthenticatesUsers;

    /**
     * Logout user (Revoke the token)
     *
     * @param Request $request Request.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(Request $request): JsonResponse
    {
        $throtleKey = Str::lower($this->user->email . '|' . $request->ip());
        if ($request->hasSession()) {
            $request->session()->invalidate();
        }
        $this->limiter()->clear($throtleKey);
        $this->auth->logout();
        $this->auth->invalidate();
        return msgOut([], '302100');
    }
}
