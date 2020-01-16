<?php

namespace App\Http\SingleActions\Backend\Merchant\User\UsersTag;

use App\Models\User\UsersTag;
use Illuminate\Http\JsonResponse;

/**
 * 用户标签-编辑
 */
class EditAction
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
     * @param  array $inputDatas 接收的参数.
     * @throws \Exception Exception.
     * @return JsonResponse
     */
    public function execute(array $inputDatas): JsonResponse
    {
        $usersTagEloq = $this->model->find($inputDatas['id']);
        if ($usersTagEloq === null) {
            throw new \Exception('200501');
        }
        $usersTagEloq->fill($inputDatas);
        if (!$usersTagEloq->save()) {
            throw new \Exception('200502');
        }
        $msgOut = msgOut(['title' => $inputDatas['title']]);
        return $msgOut;
    }
}
