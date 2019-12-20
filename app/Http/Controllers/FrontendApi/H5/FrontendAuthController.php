<?php

namespace App\Http\Controllers\FrontendApi\H5;

use App\Http\Controllers\FrontendApi\FrontendApiMainController;
use App\Http\Requests\Frontend\Common\VerificationCodeRequest;
use App\Http\SingleActions\Common\FrontendAuth\LoginAction;
use App\Http\SingleActions\Common\FrontendAuth\LogoutAction;
use App\Http\SingleActions\Common\FrontendAuth\RefreshAction;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class FrontendAuthController
 *
 * @package App\Http\Controllers\FrontendApi
 */
class FrontendAuthController extends FrontendApiMainController
{

    /**
     * @var string $eloqM
     */
    public $eloqM = 'User\FrontendUser';

    /**
     * Login user and create token
     * @param  LoginAction             $action  验证登录.
     * @param  VerificationCodeRequest $request 请求.
     * @return JsonResponse [string]  access_token
     */
    public function login(LoginAction $action, VerificationCodeRequest $request): JsonResponse
    {
        $result = $action->execute($this, $request);
        return $result;
    }

    /**
     * @param  Request      $request 请求.
     * @param  LogoutAction $action  用户退出.
     * @return JsonResponse
     */
    public function logout(Request $request, LogoutAction $action): JsonResponse
    {
        $result = $action->execute($this, $request);
        return $result;
    }

    /**
     * Refresh user token
     * @param RefreshAction $action Refresh token.
     * @return JsonResponse
     */
    public function refreshToken(RefreshAction $action): JsonResponse
    {
        $result = $action->execute($this);
        return $result;
    }
}
