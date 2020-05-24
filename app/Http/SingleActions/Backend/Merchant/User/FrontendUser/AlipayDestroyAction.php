<?php

namespace App\Http\SingleActions\Backend\Merchant\User\FrontendUser;

use App\Models\User\FrontendUser;
use App\Models\User\FrontendUsersBankCard;
use Illuminate\Http\JsonResponse;
use Log;

/**
 * 重置清空支付宝
 */
class AlipayDestroyAction
{

    /**
     * @var object
     */
    protected $model;

    /**
     * @param FrontendUser $frontendUser 用户Model.
     */
    public function __construct(FrontendUser $frontendUser)
    {
        $this->model = $frontendUser;
    }

    /**
     * @param array $inputDatas 接收的参数.
     * @return JsonResponse
     * @throws \RuntimeException Exception.
     */
    public function execute(array $inputDatas): JsonResponse
    {
        $user = $this->model->where('guid', $inputDatas['guid'])->first();
        try {
            $user->bankCard()->where('type', FrontendUsersBankCard::TYPE_ALIPAY)->delete();
        } catch (\RuntimeException $exception) {
            Log::error($exception->getMessage());
        }
        return msgOut();
    }
}
