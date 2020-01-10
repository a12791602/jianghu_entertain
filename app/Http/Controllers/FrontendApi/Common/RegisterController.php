<?php

namespace App\Http\Controllers\FrontendApi\Common;

use App\Http\Controllers\FrontendApi\FrontendApiMainController;
use App\Http\Requests\Frontend\Common\RegisterRequest;
use App\Http\Requests\Frontend\Common\RegisterVerificationCodeRequest;
use App\Http\SingleActions\Common\FrontendAuth\RegisterAction;
use App\Http\SingleActions\Common\FrontendAuth\RegisterVerificationCodeAction;
use Illuminate\Http\JsonResponse;

/**
 * Class RegisterController
 * @package App\Http\Controllers\FrontendApi\App
 */
class RegisterController extends FrontendApiMainController
{

    /**
     * Store new user.
     * @param RegisterAction  $action  RegisterAction.
     * @param RegisterRequest $request RegisterRequest.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function store(RegisterAction $action, RegisterRequest $request): JsonResponse
    {
        $result = $action->execute($request);
        return $result;
    }

    /**
     * Get registration verification code.
     * @param RegisterVerificationCodeAction  $action  RegisterVerificationCodeAction.
     * @param RegisterVerificationCodeRequest $request VerificationCodeRequest.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function code(RegisterVerificationCodeAction $action, RegisterVerificationCodeRequest $request): JsonResponse
    {
        $inputDatas = $request->validated();
        $result     = $action->execute($this, $inputDatas);
        return $result;
    }
}
