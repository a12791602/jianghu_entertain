<?php


namespace App\Lib\ErrorsHandler\Formatters;

use Exception;
use Illuminate\Http\JsonResponse;

class PDOExceptionFormatter extends ExceptionFormatter
{
    public function format(JsonResponse $response, Exception $e, array $reporterResponses)
    {
        $data = $response->getData(true);
        $serverCode = 403;
        $response->setStatusCode($serverCode);//Forbidden
        $message = $e->getMessage();
        $data = array_merge($data, [
            'code' => (string) $e->getCode(),
            'message' => $message,
        ]);
        $response->setData($data);
    }
}
