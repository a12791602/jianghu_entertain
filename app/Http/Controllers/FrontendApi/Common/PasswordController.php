<?php

namespace App\Http\Controllers\FrontendApi\Common;

use App\Http\Controllers\FrontendApi\FrontendApiMainController;
use App\Http\Requests\Frontend\Common\ResetPasswordRequest;
use App\Http\Requests\Frontend\Common\SecurityCodeRequest;
use App\Http\Requests\Frontend\Common\SecurityVerificationCodeRequest;
use App\Http\SingleActions\Common\FrontendAuth\ResetPasswordAction;
use App\Http\SingleActions\Common\FrontendAuth\SecurityCodeAction;
use App\Http\SingleActions\Common\FrontendAuth\VerificationCodeAction;
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
     * @param VerificationCodeAction $action  VerificationCodeAction.
     * @param ResetPasswordRequest   $request ResetPasswordRequest.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function passwordCode(VerificationCodeAction $action, ResetPasswordRequest $request): JsonResponse
    {
        $inputDatas = $request->validated();
        $result     = $action->execute($inputDatas);
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
     * @param VerificationCodeAction          $action  VerificationCodeAction.
     * @param SecurityVerificationCodeRequest $request SecurityVerificationCodeRequest.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function securityCode(VerificationCodeAction $action, SecurityVerificationCodeRequest $request): JsonResponse
    {
        $inputDatas           = $request->validated();
        $inputDatas['mobile'] = $request->user()->mobile;
        $result               = $action->execute($inputDatas);
        return $result;
    }
}
