<?php

namespace App\Http\SingleActions\Frontend\Common\FrontendAuth;

use App\Http\SingleActions\MainAction;
use App\Models\User\FrontendUser;
use Illuminate\Http\JsonResponse;

/**
 * Class RegisterVerificationCodeAction
 * @package App\Http\SingleActions\Common\FrontendAuth
 */
class RegisterVerificationCodeAction extends MainAction
{
    /**
     * @param array $inputData InputDatas.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(array $inputData): JsonResponse
    {
        $sign   = $this->currentPlatformEloq->sign;
        $mobile = $inputData['mobile'];

        $condition = [];

        $condition['mobile']        = $mobile;
        $condition['platform_sign'] = $sign;

        if (!FrontendUser::where($condition)->get()->isEmpty()) {
            throw new \Exception('100504');
        }
        $code   = sendVerificationCode($mobile);
        $result = msgOut($code);
        return $result;
    }
}
