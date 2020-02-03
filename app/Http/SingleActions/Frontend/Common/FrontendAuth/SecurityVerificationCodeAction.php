<?php

namespace App\Http\SingleActions\Frontend\Common\FrontendAuth;

use App\Http\SingleActions\MainAction;
use Illuminate\Http\JsonResponse;

/**
 * Class SecurityVerificationCodeAction
 * @package App\Http\SingleActions\Common\FrontendAuth
 */
class SecurityVerificationCodeAction extends MainAction
{

    /**
     * Send security verification code.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(): JsonResponse
    {
        $mobile = $this->user->mobile;
        $code   = sendVerificationCode($mobile);
        $result = msgOut($code);
        return $result;
    }
}
