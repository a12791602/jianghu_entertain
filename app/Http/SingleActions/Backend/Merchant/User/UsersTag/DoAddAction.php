<?php

namespace App\Http\SingleActions\Backend\Merchant\User\UsersTag;

use App\Http\Controllers\BackendApi\BackEndApiMainController;
use App\Models\User\UsersTag;
use Illuminate\Http\JsonResponse;

/**
 * 用户标签-添加
 */
class DoAddAction
{

    /**
     * @var object
     */
    protected $model;

    /**
     * @param UsersTag $usersTag 用户标签Model.
     */
    public function __construct(UsersTag $usersTag)
    {
        $this->model = $usersTag;
    }

    /**
     * @param  BackEndApiMainController $contll     Controller.
     * @param  array                    $inputDatas 接收的参数.
     * @throws \Exception Exception.
     * @return JsonResponse
     */
    public function execute(
        BackEndApiMainController $contll,
        array $inputDatas
    ): JsonResponse {
        $inputDatas['platform_sign'] = $contll->currentPlatformEloq->sign;
        $this->model->fill($inputDatas);
        if (!$this->model->save()) {
            throw new \Exception('200500');
        }
        $msgOut = msgOut(true, ['title' => $inputDatas['title']]);
        return $msgOut;
    }
}
