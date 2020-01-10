<?php

namespace App\Http\SingleActions\Common\FrontendAuth;

use App\Http\Controllers\FrontendApi\FrontendApiMainController;
use App\Models\User\FrontendUser;
use Illuminate\Http\JsonResponse;

/**
 * Class RegisterVerificationCodeAction
 * @package App\Http\SingleActions\Common\FrontendAuth
 */
class RegisterVerificationCodeAction extends BaseAction
{
    /**
     * @param FrontendApiMainController $controller FrontendApiMainController.
     * @param array                     $inputDatas InputDatas.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(FrontendApiMainController $controller, array $inputDatas): JsonResponse
    {
        $sign   = $controller->currentPlatformEloq->sign;
        $mobile = $inputDatas['mobile'];

        $condition = [];

        $condition['mobile']        = $mobile;
        $condition['platform_sign'] = $sign;

        if (!FrontendUser::where($condition)->get()->isEmpty()) {
            throw new \Exception('100504');
        }
        $code   = $this->sendVerificationCode($mobile);
        $result = msgOut(true, $code);
        return $result;
    }
}
