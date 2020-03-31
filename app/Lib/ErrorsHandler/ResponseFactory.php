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
        return new JsonResponse(['status' => false]);
    }
}
