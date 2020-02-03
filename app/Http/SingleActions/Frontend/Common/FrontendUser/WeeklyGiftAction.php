<?php

namespace App\Http\SingleActions\Frontend\Common\FrontendUser;

use App\Http\SingleActions\MainAction;
use App\Models\User\FrontendUsersSpecificInfo;
use Illuminate\Http\JsonResponse;

/**
 * Class WeeklyGiftAction
 * @package App\Http\SingleActions\Common\FrontendUser
 */
class WeeklyGiftAction extends MainAction
{
    /**
     * Promotion gifts money.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(): JsonResponse
    {
        $specificInfo = $this->user->specificInfo;
        if (!$specificInfo->weekly_gift) {
            throw new \Exception('100802');
        }

        $specificInfo->weekly_gift = FrontendUsersSpecificInfo::WEEKLY_GIFT_CLOSE;
        $specificInfo->save();
        $result = msgOut(true, '100800');
        return $result;
    }
}
