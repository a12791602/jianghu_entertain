<?php


namespace App\Lib\ErrorsHandler\Formatters;

use Exception;
use Illuminate\Http\JsonResponse;

class AuthExceptionFormatter extends ExceptionFormatter
{
    /**
     * @param JsonResponse $response
     * @param Exception $e
     * @param array $reporterResponses
     */
    public function format(JsonResponse $response, Exception $e, array $reporterResponses)
    {
        $data = $response->getData(true);
        $serverCode = '401';
        $response->setStatusCode($serverCode);//Forbidden
        $message = __('codes-map.' . 100401);
        $data = array_merge($data, [
            'code' => $e->getCode(),
            'message' => $message,
        ]);
        $response->setData($data);
    }
}
