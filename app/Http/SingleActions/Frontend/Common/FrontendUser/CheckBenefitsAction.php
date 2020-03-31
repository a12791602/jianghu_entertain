<?php

namespace App\Http\SingleActions\Frontend\Common\FrontendUser;

use App\Http\Resources\Frontend\FrontendUser\BenefitsResource;
use App\Http\SingleActions\MainAction;
use App\Models\User\FrontendUserLevel;
use Illuminate\Http\JsonResponse;

/**
 * Class CheckBenefitsAction
 * @package App\Http\SingleActions\Frontend\Common\FrontendUser
 */
class CheckBenefitsAction extends MainAction
{

    /**
     * 每一等级对应领取状态
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(): JsonResponse
    {
        $item                   = [];
        $item['level_benefits'] = $this->user->levelBenefits;
        $item['system_level']   = FrontendUserLevel::where('platform_sign', $this->user->platform_sign)
            ->get(['level', 'experience_min', 'experience_max', 'promotion_gift', 'weekly_gift']);
        return msgOut(new BenefitsResource($item));
    }
}
