<?php

/**
 * Created by PhpStorm.
 * author: Harris
 * Date: 8/14/2019
 * Time: 5:25 PM
 */

use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;

if (!function_exists('configure')) {
    /**
     * @param  string      $platformSign 平台标识.
     * @param  string|null $sysKey       SysKey.
     * @param  string|null $default      Default.
     * @return \Illuminate\Contracts\Foundation\Application|mixed
     */
    function configure(string $platformSign, ?string $sysKey = null, ?string $default = null)
    {
        $configure = app('App\Lib\Configure');
        if (isset($sysKey)) {
            $configure = $configure->getData($platformSign, $sysKey, $default);
        }
        return $configure;
    }
}

/**
 * @param mixed  $data        Data.
 * @param string $code        Code.
 * @param string $message     Message.
 * @param string $placeholder Placeholder.
 * @param string $substituted Substituted.
 * @return JsonResponse
 * @throws Exception 异常.
 */
function msgOut(
    $data = [],
    string $code = '200',
    string $message = '',
    string $placeholder = '',
    string $substituted = ''
): JsonResponse {
    if ($placeholder === '' || $substituted === '') {
        $message = $message === '' ? __('codes-map.' . $code) : $message;
    } else {
        $message = $message === '' ? __('codes-map.' . $code, [$placeholder => $substituted]) : $message;
    }
    $datas  = [
               'status'  => true,
               'code'    => $code,
               'data'    => $data,
               'message' => $message,
              ];
    $return = Response::json($datas);
    return $return;
}

/**
 * Send the verification code.
 * @param string $mobile Mobile.
 * @return mixed[]
 * @throws Exception Exception.
 */
function sendVerificationCode(string $mobile): array
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
