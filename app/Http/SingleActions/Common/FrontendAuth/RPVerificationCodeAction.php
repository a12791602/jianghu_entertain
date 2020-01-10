<?php

namespace App\Http\SingleActions\Common\FrontendAuth;

use App\Http\Controllers\FrontendApi\FrontendApiMainController;
use App\Models\User\FrontendUser;
use Illuminate\Http\JsonResponse;

/**
 * Class RPVerificationCodeAction
 * @package App\Http\SingleActions\Common\FrontendAuth
 */
class RPVerificationCodeAction extends BaseAction
{

    /**
     * Send security verification code.
     * @param FrontendApiMainController $controller FrontendApiMainController.
     * @param array                     $inputDatas InputDatas.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(FrontendApiMainController $controller, array $inputDatas): JsonResponse
    {
        $mobile = $inputDatas['mobile'];

        $condition = [];

        $condition['mobile']        = $mobile;
        $condition['platform_sign'] = $controller->currentPlatformEloq->sign;

        if (FrontendUser::where($condition)->get()->isEmpty()) {
            throw new \Exception('100505');
        }
        $code   = $this->sendVerificationCode($mobile);
        $result = msgOut(true, $code);
        return $result;
    }
}
