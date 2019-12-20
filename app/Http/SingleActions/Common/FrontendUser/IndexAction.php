<?php

namespace App\Http\SingleActions\Common\FrontendUser;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class IndexAction
 * @package App\Http\SingleActions\Common\FrontendUser
 */
class IndexAction
{
    /**
     * @param Request $request Request.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(Request $request): JsonResponse
    {
        $user   = $request->user()->toArray();
        $result = msgOut(true, $user);
        return $result;
    }
}
