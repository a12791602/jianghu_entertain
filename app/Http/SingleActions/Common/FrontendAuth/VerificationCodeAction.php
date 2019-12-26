<?php

namespace App\Http\SingleActions\Common\FrontendAuth;

use Cache;
use Illuminate\Http\JsonResponse;
//use Log;
use Str;

/**
 * Class VerificationCodeAction
 * @package App\Http\SingleActions\Common\FrontendAuth
 */
class VerificationCodeAction
{
    /**
     * @param array $inputDatas InputDatas.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(array $inputDatas): JsonResponse
    {
        $random           = strval(random_int(1, 999999));
        $code             = str_pad($random, 6, '0', STR_PAD_LEFT);
        $mobile           = $inputDatas['mobile'];
        $expiredAt        = now()->addMinutes(10);
        $verification_key = 'verificationCode:' . Str::random(15);

        Cache::put($verification_key, ['mobile' => $mobile, 'verification_code' => $code], $expiredAt);

        $item = [
           'verification_key' => $verification_key,
           'expired_at' => $expiredAt->toDayDateTimeString(),
        ];

        if (!app()->environment('production')) {
            $item['verification_code'] = $code;
        }

        $result = msgOut(true, $item);
        return $result;
    }
}
