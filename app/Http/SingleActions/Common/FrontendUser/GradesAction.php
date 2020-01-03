<?php

namespace App\Http\SingleActions\Common\FrontendUser;

use App\Models\User\UsersGrade;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class GradesAction
 * @package App\Http\SingleActions\Common\FrontendUser
 */
class GradesAction
{
    /**
     * Get user grade rules.
     * @param Request $request Request.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(Request $request): JsonResponse
    {
        $grade = UsersGrade::where('platform_sign', $request->user()->platform_sign)
            ->get(['name', 'experience_min', 'experience_max', 'grade_gift', 'week_gift']);

        $result = msgOut(true, $grade);
        return $result;
    }
}
