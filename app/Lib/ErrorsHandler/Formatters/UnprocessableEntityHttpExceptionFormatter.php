<?php

namespace App\Lib\ErrorsHandler\Formatters;

use Illuminate\Http\JsonResponse;

/**
 * Class UnprocessableEntityHttpExceptionFormatter
 * @package App\Lib\ErrorsHandler\Formatters
 */
class UnprocessableEntityHttpExceptionFormatter extends BaseFormatter
{
    /**
     * @param JsonResponse $response Response.
     * @param \Throwable   $e        Throwable Errors.
     * @throws \JsonException Throw Exception.
     * @return void
     */
    public function format(JsonResponse $response, \Throwable $e): void
    {
        $response->setStatusCode(422);
        // Laravel validation errors will return JSON string
        $decoded = json_decode($e->getMessage(), true, 512, JSON_THROW_ON_ERROR);
        // Message was not valid JSON
        // This occurs when we throw UnprocessableEntityHttpExceptions
        if (json_last_error() !== JSON_ERROR_NONE) {
            // Mimick the structure of Laravel validation errors
            $decoded = [[$e->getMessage()]];
        }
        // Laravel errors are formatted as {"field": [/*errors as strings*/]}
        $data = array_reduce(
            $decoded,
            static function ($carry, $item) use ($e) {
                $data = array_merge(
                    $carry,
                    array_map(
                        static function ($current) use ($e) {
                            $data = [
                                     'status' => '422',
                                     'code'   => $e->getCode(),
                                     'title'  => 'Validation error',
                                     'detail' => $current,
                                    ];
                            return $data;
                        },
                        $item,
                    ),
                );//array_merge End;
                return $data;
            },
            [],
        );
        $response->setData(
            ['errors' => $data],
        );
    }
}
