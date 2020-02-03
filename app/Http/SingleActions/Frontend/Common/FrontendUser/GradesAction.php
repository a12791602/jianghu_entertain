<?php

namespace App\Http\SingleActions\Frontend\Common\FrontendUser;

use App\Http\SingleActions\MainAction;
use App\Models\User\UsersGrade;
use Illuminate\Http\JsonResponse;

/**
 * Class GradesAction
 * @package App\Http\SingleActions\Common\FrontendUser
 */
class GradesAction extends MainAction
{
    /**
     * Get user grade rules.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(): JsonResponse
    {
        $grade = UsersGrade::where('platform_sign', $this->user->platform_sign)
            ->get(['name', 'experience_min', 'experience_max', 'grade_gift', 'week_gift']);

        $result = msgOut($grade);
        return $result;
    }
}
