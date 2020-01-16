<?php

namespace App\Http\SingleActions\Backend\Merchant\User\UserBlackList;

use App\Models\User\FrontendUsersBlackList;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Carbon;

/**
 * 解除黑名单
 */
class RemoveAction
{

    /**
     * @var object
     */
    protected $model;

    /**
     * @param FrontendUsersBlackList $frontendUsersBlackList 用户黑名单Model.
     */
    public function __construct(FrontendUsersBlackList $frontendUsersBlackList)
    {
        $this->model = $frontendUsersBlackList;
    }

    /**
     * @param array $inputDatas 接收的参数.
     * @throws \Exception Exception.
     * @return JsonResponse
     */
    public function execute(array $inputDatas): JsonResponse
    {
        $userBlackELoq = $this->model->find($inputDatas['id']);
        if ($userBlackELoq === null) {
            throw new \Exception('200300');
        }
        $userBlackELoq->status      = $this->model::STATUS_WHITE;
        $userBlackELoq->remove_time = Carbon::now();
        if (!$userBlackELoq->save()) {
            throw new \Exception('200301');
        }
        $msgOut = msgOut(['mobile' => $userBlackELoq->mobile]);
        return $msgOut;
    }
}
