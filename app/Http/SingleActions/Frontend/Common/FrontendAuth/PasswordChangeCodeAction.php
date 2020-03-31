<?php

namespace App\Http\SingleActions\Frontend\Common\FrontendAuth;

use App\Http\SingleActions\MainAction;
use Illuminate\Http\JsonResponse;

/**
 * Class PasswordChangeCodeAction
 * @package App\Http\SingleActions\Frontend\Common\FrontendAuth
 */
class PasswordChangeCodeAction extends MainAction
{

    /**
     * Send change password verification code.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(): JsonResponse
    {
        $code = sendVerificationCode($this->user->mobile);
        return msgOut($code);
    }
}
