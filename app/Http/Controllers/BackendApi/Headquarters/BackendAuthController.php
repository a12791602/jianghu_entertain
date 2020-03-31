<?php

namespace App\Http\Controllers\BackendApi\Headquarters;

use App\Http\SingleActions\Common\Backend\LoginAction;
use App\Http\SingleActions\Common\Backend\LogoutAction;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * 后台管理员
 */
class BackendAuthController
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
        return $action->execute($request);
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
        return $action->execute($request);
    }
}
