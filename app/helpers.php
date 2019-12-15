<?php

/**
 * Created by PhpStorm.
 * author: Harris
 * Date: 8/14/2019
 * Time: 5:25 PM
 */

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;

if (!function_exists('configure')) {
    /**
     * @param  string|null $sysKey  SysKey.
     * @param  string|null $default Default.
     * @return \Illuminate\Contracts\Foundation\Application|mixed
     */
    function configure(?string $sysKey = null, ?string $default = null)
    {
        $configure = app('Configure');
        if (isset($sysKey)) {
            $configure = $configure->getData($sysKey, $default);
        }
        return $configure;
    }
}


/**
 * @param boolean $success     Success.
 * @param mixed   $data        Data.
 * @param string  $code        Code.
 * @param string  $message     Message.
 * @param string  $placeholder Placeholder.
 * @param string  $substituted Substituted.
 * @return JsonResponse
 * @throws Exception 异常.
 */
function msgOut(
    bool $success = false,
    $data = [],
    string $code = '',
    string $message = '',
    string $placeholder = '',
    string $substituted = ''
): JsonResponse {
    $defaultSuccessCode = '200';
    $defaultErrorCode   = '404';
    $defaultCode        = $success === true ? $defaultSuccessCode : $defaultErrorCode;
    $code               = $code === '' ? $defaultCode : $code;
    if ($success === false) {
        throw new Exception($code);
    }
    if ($placeholder === '' || $substituted === '') {
        $message = $message === '' ? __('codes-map.' . $code) : $message;
    } else {
        $message = $message === '' ? __('codes-map.' . $code, [$placeholder => $substituted]) : $message;
    }
    $datas = [
        'status' => true,
        'code' => $code,
        'data' => $data,
        'message' => $message,
    ];
    $return = Response::json($datas);
    return $return;
}
