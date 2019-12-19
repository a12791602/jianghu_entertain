<?php

namespace App\Http\Controllers\BackendApi\Merchant;

use App\Http\Controllers\BackendApi\BackEndApiMainController;
use App\Http\SingleActions\Common\MerchantAuth\LoginAction;
use App\Http\SingleActions\Common\MerchantAuth\LogoutAction;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * 运营商管理员
 */
class MerchantAuthController extends BackEndApiMainController
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
