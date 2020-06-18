<?php

namespace App\Http\Controllers\FrontendApi\Common;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\Common\PasswordChangeRequest;
use App\Http\Requests\Frontend\Common\PVerificationCodeRequest;
use App\Http\Requests\Frontend\Common\ResetPasswordRequest;
use App\Http\Requests\Frontend\Common\SecurityCodeRequest;
use App\Http\SingleActions\Frontend\Common\FrontendAuth\PasswordChangeAction;
use App\Http\SingleActions\Frontend\Common\FrontendAuth\PasswordChangeCodeAction;
use App\Http\SingleActions\Frontend\Common\FrontendAuth\ResetPasswordAction;
use App\Http\SingleActions\Frontend\Common\FrontendAuth\RPVerificationCodeAction;
use App\Http\SingleActions\Frontend\Common\FrontendAuth\SecurityCodeAction;
use App\Http\SingleActions\Frontend\Common\FrontendAuth\SecurityVerificationCodeAction;
use Illuminate\Http\JsonResponse;

/**
 * Class ResetPasswordController
 * @package App\Http\Controllers\FrontendApi\Common
 */
class PasswordController extends Controller
{

    /**
     * Reset frontend-user password
     * @param ResetPasswordAction  $action  ResetPasswordAction.
     * @param ResetPasswordRequest $request ResetPasswordRequest.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function passwordReset(
        ResetPasswordAction $action,
        ResetPasswordRequest $request
    ): JsonResponse {
        return $action->execute($request);
    }

    /**
     * Get reset password verification code.
     * @param RPVerificationCodeAction $action  VerificationCodeAction.
     * @param PVerificationCodeRequest $request PVerificationCodeRequest.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function passwordResetCode(
        RPVerificationCodeAction $action,
        PVerificationCodeRequest $request
    ): JsonResponse {
        $inputDatas = $request->validated();
        return $action->execute($inputDatas);
    }

    /**
     * Frontend-user change password.
     * @param PasswordChangeAction  $action  PasswordChangeAction.
     * @param PasswordChangeRequest $request PasswordChangeRequest.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function passwordChange(
        PasswordChangeAction $action,
        PasswordChangeRequest $request
    ): JsonResponse {
        return $action->execute($request);
    }

    /**
     * Get change password verification code.
     * @param PasswordChangeCodeAction $action PasswordChangeCodeAction.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function passwordChangeCode(PasswordChangeCodeAction $action): JsonResponse
    {
        return $action->execute();
    }

    /**
     * Change front-end user security code
     * @param SecurityCodeAction  $action  SecurityCodeAction.
     * @param SecurityCodeRequest $request SecurityCodeRequest.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function security(
        SecurityCodeAction $action,
        SecurityCodeRequest $request
    ): JsonResponse {
        $validated = $request->validated();
        return $action->execute($validated);
    }

    /**
     * Get security verification code.
     * @param SecurityVerificationCodeAction $action SecurityVerificationCodeAction.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function securityCode(SecurityVerificationCodeAction $action): JsonResponse
    {
        return $action->execute();
    }
}
