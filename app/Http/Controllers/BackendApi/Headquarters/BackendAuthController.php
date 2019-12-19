<?php

namespace App\Http\Controllers\BackendApi\Headquarters;

use App\Http\Controllers\BackendApi\BackEndApiMainController;
use App\Http\SingleActions\Common\Backend\LoginAction;
use App\Http\SingleActions\Common\Backend\LogoutAction;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * 后台管理员
 */
class BackendAuthController extends BackEndApiMainController
{

    /**
     * Login user and create token
     *
     * @param  Request     $request Request.
     * @param  LoginAction $action  Action.
     * @return JsonResponse
     */
    public function login(Request $request, LoginAction $action): JsonResponse
    {
        $msgOut = $action->execute($this, $request);
        return $msgOut;
    }

    /**
     * Logout user (Revoke the token)
     *
     * @param  Request      $request Request.
     * @param  LogoutAction $action  Action.
     * @return JsonResponse
     */
    public function logout(Request $request, LogoutAction $action): JsonResponse
    {
        $msgOut = $action->execute($this, $request);
        return $msgOut;
    }
}
