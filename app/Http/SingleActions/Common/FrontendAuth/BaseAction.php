<?php

namespace App\Http\SingleActions\Common\FrontendAuth;

use Cache;
use Carbon\Carbon;
use Str;

/**
 * Class BaseAction
 * @package App\Http\SingleActions\Common\FrontendAuth
 */
class BaseAction
{
    /**
     * Send the verification code.
     * @param string $mobile Mobile.
     * @return mixed[]
     * @throws \Exception Exception.
     */
    public function sendVerificationCode(string $mobile): array
    {
        $random           = strval(random_int(1, 999999));
        $code             = str_pad($random, 6, '0', STR_PAD_LEFT);
        $currentReqTime   = Carbon::now()->timestamp;
        $nextReqTime      = Carbon::now()->addMinutes(1)->timestamp;
        $expiredAt        = now()->addMinutes(10);
        $verification_key = 'verificationCode:' . Str::random(15);

        Cache::put($verification_key, ['mobile' => $mobile, 'verification_code' => $code], $expiredAt);

        $item = [
                 'verification_key' => $verification_key,
                 'expired_at'       => $expiredAt->toDayDateTimeString(),
                 'nextReqTime'      => $nextReqTime, // Next allowed request timestamp.
                 'currentReqTime'   => $currentReqTime, // Current request timestamp.
                ];

        if (!app()->environment('production')) {
            $item['verification_code'] = $code;
        }

        return $item;
    }
}
