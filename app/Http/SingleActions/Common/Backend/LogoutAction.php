<?php

namespace App\Http\SingleActions\Common\Backend;

use App\Http\Controllers\BackendApi\BackEndApiMainController;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

/**
 * Class for backend auth logout action.
 */
class LogoutAction
{
    use AuthenticatesUsers;

    /**
     * Logout user (Revoke the token)
     *
     * @param  BackEndApiMainController $contll  Controller.
     * @param  Request                  $request Request.
     * @return JsonResponse
     */
    public function execute(BackEndApiMainController $contll, Request $request): JsonResponse
    {
        $throtleKey = Str::lower($contll->currentAdmin->email . '|' . $request->ip());
        if ($request->hasSession()) {
            $request->session()->invalidate();
        }
        $this->limiter()->clear($throtleKey);
        $contll->currentAuth->logout();
        $contll->currentAuth->invalidate();
        $msgOut = msgOut([], '302100');
        return $msgOut;
    }
}
