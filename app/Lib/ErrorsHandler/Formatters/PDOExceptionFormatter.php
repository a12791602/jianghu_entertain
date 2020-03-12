<?php

namespace App\Lib\ErrorsHandler\Formatters;

use Illuminate\Http\JsonResponse;

/**
 * Class PDOExceptionFormatter
 * @package App\Lib\ErrorsHandler\Formatters
 */
class PDOExceptionFormatter extends ExceptionFormatter
{

    /**
     * @param JsonResponse $response Response.
     * @param \Throwable   $e        Throwable Errors.
     * @return void
     */
    public function format(JsonResponse $response, \Throwable $e): void
    {
        $data       = $response->getData(true);
        $serverCode = 403;
        $response->setStatusCode($serverCode);//Forbidden
        $message = $e->getMessage();
        $data    = array_merge(
            $data,
            [
             'code'    => (string) $e->getCode(),
             'message' => __($message),
            ],
        );
        $response->setData($data);
    }
}
