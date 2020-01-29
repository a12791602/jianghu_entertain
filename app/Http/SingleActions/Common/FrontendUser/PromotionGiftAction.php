<?php

namespace App\Http\SingleActions\Common\FrontendUser;

use App\Models\User\FrontendUsersSpecificInfo;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class PromotionGiftsAction
 * @package App\Http\SingleActions\Common\FrontendUser
 */
class PromotionGiftAction
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
        if (!$specificInfo->promotion_gift) {
            throw new \Exception('100801');
        }

        $specificInfo->promotion_gift = FrontendUsersSpecificInfo::PROMOTION_GIFT_CLOSE;
        $specificInfo->save();
        $result = msgOut(true, '100800');
        return $result;
    }
}
