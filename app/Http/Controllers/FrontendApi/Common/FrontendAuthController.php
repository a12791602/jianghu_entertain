<?php

namespace App\Http\Controllers\FrontendApi\Common;

use App\Http\Requests\Frontend\Common\LoginVerificationRequest;
use App\Http\SingleActions\Frontend\Common\FrontendAuth\LoginAction;
use App\Http\SingleActions\Frontend\Common\FrontendAuth\LogoutAction;
use App\Http\SingleActions\Frontend\Common\FrontendAuth\RefreshAction;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class FrontendAuthController
 *
 * @package App\Http\Controllers\FrontendApi
 */
class FrontendAuthController
{

    /**
     * Login user and create token
     * @param LoginVerificationRequest $request 请求.
     * @param LoginAction              $action  验证登录.
     * @return JsonResponse [string]  access_token
     * @throws \Exception Exception.
     */
    public function login(LoginVerificationRequest $request, LoginAction $action): JsonResponse
    {
        return $action->execute($request);
    }

    /**
     * @param Request      $request 请求.
     * @param LogoutAction $action  用户退出.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function logout(Request $request, LogoutAction $action): JsonResponse
    {
        return $action->execute($request);
    }

    /**
     * Refresh user token
     * @param RefreshAction $action Refresh token.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function refreshToken(RefreshAction $action): JsonResponse
    {
        return $action->execute();
    }
}
