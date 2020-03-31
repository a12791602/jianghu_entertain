<?php

namespace App\Http\SingleActions\Frontend\Common\VerificationCode;

use App\Http\SingleActions\MainAction;
use Illuminate\Http\JsonResponse;

/**
 * Non-open routing.
 * Class PrivateVerificationCodeAction
 * @package App\Http\SingleActions\Frontend\Common\System
 */
class PrivateVerificationCodeAction extends MainAction
{

    /**
     * Get verification code.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(): JsonResponse
    {
        $code = sendVerificationCode($this->user->mobile);
        return msgOut($code);
    }
}
