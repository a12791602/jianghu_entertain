<?php

namespace App\Http\Controllers\FrontendApi\Common;

use App\Http\Controllers\FrontendApi\FrontendApiMainController;
use App\Http\Requests\Frontend\Common\PVerificationCodeRequest;
use App\Http\Requests\Frontend\Common\ResetPasswordRequest;
use App\Http\Requests\Frontend\Common\SecurityCodeRequest;
use App\Http\SingleActions\Common\FrontendAuth\ResetPasswordAction;
use App\Http\SingleActions\Common\FrontendAuth\RPVerificationCodeAction;
use App\Http\SingleActions\Common\FrontendAuth\SecurityCodeAction;
use App\Http\SingleActions\Common\FrontendAuth\SecurityVerificationCodeAction;
use Illuminate\Http\JsonResponse;

/**
 * Class ResetPasswordController
 * @package App\Http\Controllers\FrontendApi\Common
 */
class PasswordController extends FrontendApiMainController
{

    /**
     * Reset frontend-user password
     * @param ResetPasswordAction  $action  ResetPasswordAction.
     * @param ResetPasswordRequest $request ResetPasswordRequest.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function password(ResetPasswordAction $action, ResetPasswordRequest $request): JsonResponse
    {
        $result = $action->execute($request);
        return $result;
    }

    /**
     * Get reset password verification code.
     * @param RPVerificationCodeAction $action  VerificationCodeAction.
     * @param PVerificationCodeRequest $request PVerificationCodeRequest.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function passwordCode(RPVerificationCodeAction $action, PVerificationCodeRequest $request): JsonResponse
    {
        $inputDatas = $request->validated();
        $result     = $action->execute($this, $inputDatas);
        return $result;
    }

    /**
     * Change front-end user security code
     * @param SecurityCodeAction  $action  SecurityCodeAction.
     * @param SecurityCodeRequest $request SecurityCodeRequest.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function security(SecurityCodeAction $action, SecurityCodeRequest $request): JsonResponse
    {
        $result = $action->execute($request);
        return $result;
    }

    /**
     * Get security verification code.
     * @param SecurityVerificationCodeAction $action SecurityVerificationCodeAction.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function securityCode(SecurityVerificationCodeAction $action): JsonResponse
    {
        $result = $action->execute($this);
        return $result;
    }
}
