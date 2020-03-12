<?php

namespace App\Lib\ErrorsHandler\Formatters;

use Illuminate\Http\JsonResponse;

/**
 * Class AuthExceptionFormatter
 * @package App\Lib\ErrorsHandler\Formatters
 */
class AuthExceptionFormatter extends ExceptionFormatter
{
    /**
     * @param JsonResponse $response Response.
     * @param \Throwable   $e        Throwable Exception.
     * @return void
     */
    public function format(JsonResponse $response, \Throwable $e): void
    {
        $data       = $response->getData(true);
        $serverCode = 401;
        $response->setStatusCode($serverCode);//Forbidden
        $message = __('codes-map.' . 100401);
        $data    = array_merge(
            $data,
            [
             'code'    => (string) $e->getCode(),
             'message' => is_string($message) ? __($message) : $message,
            ],
        );
        $response->setData($data);
    }
}
