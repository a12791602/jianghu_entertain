<?php

namespace App\Http\Controllers\FrontendApi\App;

use App\Http\Controllers\FrontendApi\FrontendApiMainController;
use App\Http\Requests\Frontend\Common\RegisterRequest;
use App\Http\Requests\Frontend\Common\VerificationCodeRequest;
use App\Http\SingleActions\Common\FrontendAuth\RegisterAction;
use App\Http\SingleActions\Common\FrontendAuth\VerificationCodeAction;
use Illuminate\Http\JsonResponse;

/**
 * Class RegisterController
 * @package App\Http\Controllers\FrontendApi\App
 */
class RegisterController extends FrontendApiMainController
{

    /**
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
     * @param VerificationCodeAction  $action  VerificationCodeAction.
     * @param VerificationCodeRequest $request VerificationCodeRequest.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function code(VerificationCodeAction $action, VerificationCodeRequest $request): JsonResponse
    {
        $inputDatas = $request->validated();
        $result     = $action->execute($inputDatas);
        return $result;
    }
}
