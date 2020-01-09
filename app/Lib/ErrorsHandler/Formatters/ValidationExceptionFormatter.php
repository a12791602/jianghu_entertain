<?php


namespace App\Lib\ErrorsHandler\Formatters;

use Exception;
use Illuminate\Http\JsonResponse;

class ValidationExceptionFormatter extends BaseFormatter
{
    public function format(JsonResponse $response, Exception $e, array $reporterResponses)
    {
        $data = $response->getData(true);
        $serverCode = '403';
        $response->setStatusCode($serverCode);//Forbidden
        $message = $e->validator->getMessageBag()->first();
        $data = array_merge($data, [
            'code' => $serverCode,
            'message' => $message,
        ]);
        $response->setData($data);
    }

}
