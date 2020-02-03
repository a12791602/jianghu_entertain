<?php

namespace App\Http\SingleActions\Frontend\Common\FrontendUser;

use App\Http\SingleActions\MainAction;
use App\Models\User\FrontendUsersSpecificInfo;
use Illuminate\Http\JsonResponse;

/**
 * Class PromotionGiftsAction
 * @package App\Http\SingleActions\Common\FrontendUser
 */
class PromotionGiftAction extends MainAction
{
    /**
     * Promotion gifts money.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(): JsonResponse
    {
        $specificInfo = $this->user->specificInfo;
        if (!$specificInfo->promotion_gift) {
            throw new \Exception('100801');
        }

        $specificInfo->promotion_gift = FrontendUsersSpecificInfo::PROMOTION_GIFT_CLOSE;
        $specificInfo->save();
        $result = msgOut(true, '100800');
        return $result;
    }
}
