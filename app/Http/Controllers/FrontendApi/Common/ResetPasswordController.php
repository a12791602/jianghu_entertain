<?php

namespace App\Http\Controllers\FrontendApi\Common;

use App\Http\Controllers\FrontendApi\FrontendApiMainController;
use App\Http\Requests\Frontend\Common\ResetPasswordRequest;
use App\Http\SingleActions\Common\FrontendAuth\ResetPasswordAction;
use App\Http\SingleActions\Common\FrontendAuth\VerificationCodeAction;
use Illuminate\Http\JsonResponse;

/**
 * Class ResetPasswordController
 * @package App\Http\Controllers\FrontendApi\Common
 */
class ResetPasswordController extends FrontendApiMainController
{

    /**
     * Reset frontend-user password
     * @param ResetPasswordAction  $action  ResetPasswordAction.
     * @param ResetPasswordRequest $request ResetPasswordRequest.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function store(ResetPasswordAction $action, ResetPasswordRequest $request): JsonResponse
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
    public function code(VerificationCodeAction $action, ResetPasswordRequest $request): JsonResponse
    {
        $inputDatas = $request->validated();
        $result     = $action->execute($inputDatas);
        return $result;
    }
}
