<?php

namespace App\Lib\ErrorsHandler\Formatters;

use Illuminate\Http\JsonResponse;

/**
 * Class HttpExceptionFormatter
 * @package App\Lib\ErrorsHandler\Formatters
 */
class HttpExceptionFormatter extends ExceptionFormatter
{
    /**
     * @param JsonResponse $response Response.
     * @param \Throwable   $e        Throwable Exception.
     * @return void
     */
    public function format(JsonResponse $response, \Throwable $e): void
    {
        parent::format($response, $e);
        $headers = $e->getHeaders();
        if (count($headers)) {
            $response->headers->add($headers);
        }
        $response->setStatusCode($e->getStatusCode());
    }
}
