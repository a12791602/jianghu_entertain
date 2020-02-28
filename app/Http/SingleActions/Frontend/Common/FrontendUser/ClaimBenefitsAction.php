<?php

namespace App\Http\SingleActions\Frontend\Common\FrontendUser;

use App\Http\SingleActions\MainAction;
use App\Models\User\FrontendUserLevelBenefit;
use Illuminate\Http\JsonResponse;
use Log;

/**
 * Class ClaimBenefitsAction
 * @package App\Http\SingleActions\Frontend\Common\FrontendUser
 */
class ClaimBenefitsAction extends MainAction
{

    /**
     * 领取会员权益 [周礼金, 晋级礼金].
     * @param array $request Benefit types.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(array $request): JsonResponse
    {
        $type                 = $request['type'];
        $other_type           = json_decode($request['other_type'], true);
        $item                 = [];
        $condition            = [];
        $condition['level']   = $request['level'];
        $condition['user_id'] = $this->user->id;
        $user_level           = $this->user->specificInfo->level;
        if ($request['level'] > $user_level) {
            throw new \Exception('100805');
        }
        try {
            if ($type === 'weekly_gift') {
                $condition['promotion_gift'] = $other_type['promotion_gift'];
                $item[$type]                 = FrontendUserLevelBenefit::WEEKLY_GIFT_RECEIVED;
                if (FrontendUserLevelBenefit::where(array_merge($condition, $item))->exists()) {
                    throw new \Exception('100805');
                }
                FrontendUserLevelBenefit::where($condition)->update($item);
            } else {
                $condition['weekly_gift'] = $other_type['weekly_gift'];
                $item[$type]              = FrontendUserLevelBenefit::PROMOTION_GIFT_RECEIVED;
                if (FrontendUserLevelBenefit::where(array_merge($condition, $item))->exists()) {
                    throw new \Exception('100805');
                }
                FrontendUserLevelBenefit::where($condition)->update($item);
            }
            $result = msgOut([], '100800');
            return $result;
        } catch (\Throwable $exception) {
            Log::error($exception->getMessage());
        }
        throw new \Exception('100804');
    }
}
