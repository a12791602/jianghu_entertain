<?php

namespace App\Lib\ErrorsHandler\Formatters;

use Illuminate\Http\JsonResponse;

/**
 * Class ValidationExceptionFormatter
 * @package App\Lib\ErrorsHandler\Formatters
 */
class ValidationExceptionFormatter extends BaseFormatter
{
    /**
     * @param JsonResponse $response Response.
     * @param \Throwable   $e        Errors.
     * @return void
     */
    public function format(JsonResponse $response, \Throwable $e): void
    {
        $data       = $response->getData(true);
        $serverCode = 403;
        $response->setStatusCode($serverCode);//Forbidden
        $message = $e->validator->getMessageBag()->first();
        $data    = array_merge(
            $data,
            [
             'code'    => (string) $serverCode,
             'message' => __($message),
            ],
        );
        $response->setData($data);
    }
}
