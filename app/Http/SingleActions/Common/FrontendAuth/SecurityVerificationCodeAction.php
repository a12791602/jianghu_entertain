<?php

namespace App\Http\SingleActions\Common\FrontendAuth;

use App\Http\Controllers\FrontendApi\FrontendApiMainController;
use Illuminate\Http\JsonResponse;

/**
 * Class SecurityVerificationCodeAction
 * @package App\Http\SingleActions\Common\FrontendAuth
 */
class SecurityVerificationCodeAction extends BaseAction
{

    /**
     * Send security verification code.
     * @param FrontendApiMainController $controller FrontendApiMainController.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(FrontendApiMainController $controller): JsonResponse
    {
        $mobile = $controller->currentAuth->user()->mobile;
        $code   = $this->sendVerificationCode($mobile);
        $result = msgOut($code);
        return $result;
    }
}
