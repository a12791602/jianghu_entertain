<?php

namespace App\Http\SingleActions\Frontend\Common\FrontendUser;

use App\Http\Resources\Frontend\FrontendUser\UserLevelResource;
use App\Http\SingleActions\MainAction;
use App\Models\User\FrontendUserLevel;
use Illuminate\Http\JsonResponse;

/**
 * Class UserLevelAction
 * @package App\Http\SingleActions\Common\FrontendUser
 */
class UserLevelAction extends MainAction
{
    /**
     * Get user grade rules.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(): JsonResponse
    {
        $grade = FrontendUserLevel::where('platform_sign', $this->user->platform_sign)
            ->get(['level', 'experience_min', 'experience_max', 'grade_gift', 'week_gift']);

        $result = msgOut(UserLevelResource::collection($grade));
        return $result;
    }
}
