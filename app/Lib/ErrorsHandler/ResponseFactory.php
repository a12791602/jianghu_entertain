<?php

namespace App\Lib\ErrorsHandler;

use Illuminate\Http\JsonResponse;

/**
 * Class ResponseFactory
 *
 * @package App\Lib\ErrorsHandler
 */
class ResponseFactory
{
    /**
     * package the result
     *
     * @return JsonResponse
     */
    public static function make(): JsonResponse
    {
        $response = new JsonResponse(['status' => false]);
        return $response;
    }
}
