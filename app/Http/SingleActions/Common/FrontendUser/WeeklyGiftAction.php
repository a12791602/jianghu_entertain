<?php

namespace App\Http\SingleActions\Common\FrontendUser;

use App\Models\User\FrontendUsersSpecificInfo;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class WeeklyGiftAction
 * @package App\Http\SingleActions\Common\FrontendUser
 */
class WeeklyGiftAction
{
    /**
     * Promotion gifts money.
     * @param Request $request Request.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(Request $request): JsonResponse
    {
        $specificInfo = $request->user()->specificInfo;
        if (!$specificInfo->weekly_gift) {
            throw new \Exception('100802');
        }

        $specificInfo->weekly_gift = FrontendUsersSpecificInfo::WEEKLY_GIFT_CLOSE;
        $specificInfo->save();
        $result = msgOut(true, '100800');
        return $result;
    }
}
