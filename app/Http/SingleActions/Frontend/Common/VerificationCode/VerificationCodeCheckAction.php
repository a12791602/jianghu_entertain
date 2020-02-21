<?php

namespace App\Http\SingleActions\Frontend\Common\VerificationCode;

use App\Http\SingleActions\MainAction;
use Cache;

/**
 * Class VerificationCodeCheckAction
 * @package App\Http\SingleActions\Frontend\Common
 */
class VerificationCodeCheckAction extends MainAction
{

    /**
     * Check the verification code and key passed by the user.
     * @param array $request Request.
     * @return string
     * @throws \Exception Exception.
     */
    public function checkVerificationCode(array $request): string
    {
        $verification_key = $request['verification_key'];
        $verifyData       = Cache::get($verification_key);
        if (!$verifyData) {
            throw new \Exception('100502');
        }
        if (!hash_equals($verifyData['verification_code'], $request['verification_code'])) {
            throw new \Exception('100503', 401);
        }
        return $verification_key;
    }
}
