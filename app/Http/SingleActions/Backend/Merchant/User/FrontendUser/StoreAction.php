<?php

namespace App\Http\SingleActions\Backend\Merchant\User\FrontendUser;

use App\Http\SingleActions\MainAction;
use App\Models\User\FrontendUser;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Log;

/**
 * 会员添加
 */
class StoreAction extends MainAction
{

    /**
     * @var object
     */
    protected $model;

    /**
     * StoreAction constructor.
     * @param Request      $request      Request.
     * @param FrontendUser $frontendUser 用户Model.
     * @throws \Exception Exception.
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
        $inputDatas['platform_id']   = $this->currentPlatformEloq->id;
        $inputDatas['platform_sign'] = $this->currentPlatformEloq->sign;
        $inputDatas['password']      = bcrypt($inputDatas['password']);
        try {
            $this->model->create($inputDatas);
        } catch (\RuntimeException $exception) {
            Log::error($exception->getMessage());
        }
        $msgOut = msgOut();
        return $msgOut;
    }
}
