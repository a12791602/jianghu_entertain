<?php

namespace App\Http\SingleActions\Backend\Merchant\User\FrontendUser;

use App\Http\SingleActions\MainAction;
use App\Models\User\FrontendUser;
use Cache;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * 会员解锁
 */
class UnlockAction extends MainAction
{

    /**
     * @var object
     */
    protected $model;

    /**
     * @param Request      $request      Request.
     * @param FrontendUser $frontendUser 用户Model.
     */
    public function __construct(Request $request, FrontendUser $frontendUser)
    {
        parent::__construct($request);
        $this->model = $frontendUser;
    }

    /**
     * @param array $inputDatas 接收的参数.
     * @return JsonResponse
     * @throws \RuntimeException Exception.
     */
    public function execute(array $inputDatas): JsonResponse
    {
        $mobile        = $inputDatas['mobile'];
        $platform_sign = $this->currentPlatformEloq->sign;
        $condition     = [
                          'platform_sign' => $platform_sign,
                          'mobile'        => $mobile,
                         ];
        $user          = $this->model->where($condition)->first();
        $user->status  = FrontendUser::STATUS_NORMAL;
        $user->save();
        $login_attempt_prefix = $platform_sign . ':frontend_user_' . $mobile;
        Cache::delete($login_attempt_prefix);
        return msgOut();
    }
}
