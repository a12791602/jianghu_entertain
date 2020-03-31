<?php

namespace App\Http\SingleActions\Frontend\Common\FrontendAuth;

use App\Http\SingleActions\MainAction;
use App\Models\User\FrontendUser;
use Illuminate\Http\JsonResponse;

/**
 * Class RPVerificationCodeAction
 * @package App\Http\SingleActions\Common\FrontendAuth
 */
class RPVerificationCodeAction extends MainAction
{

    /**
     * Send security verification code.
     * @param array $inputDatas InputDatas.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(array $inputDatas): JsonResponse
    {
        $mobile = $inputDatas['mobile'];

        $condition = [];

        $condition['mobile']        = $mobile;
        $condition['platform_sign'] = $this->currentPlatformEloq->sign;

        if (FrontendUser::where($condition)->get()->isEmpty()) {
            throw new \Exception('100505');
        }
        $code = sendVerificationCode($mobile);
        return msgOut($code);
    }
}
