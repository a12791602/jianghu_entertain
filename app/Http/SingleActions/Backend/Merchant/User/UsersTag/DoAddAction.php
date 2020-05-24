<?php

namespace App\Http\SingleActions\Backend\Merchant\User\UsersTag;

use App\Http\SingleActions\MainAction;
use App\Models\User\UsersTag;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * 用户标签-添加
 */
class DoAddAction extends MainAction
{

    /**
     * @var object
     */
    protected $model;

    /**
     * @param UsersTag $usersTag 用户标签Model.
     * @param Request  $request  Request.
     * @throws \Exception Exception.
     */
    public function __construct(UsersTag $usersTag, Request $request)
    {
        parent::__construct($request);
        $this->model = $usersTag;
    }

    /**
     * @param  array $inputDatas 接收的参数.
     * @throws \Exception Exception.
     * @return JsonResponse
     */
    public function execute(array $inputDatas): JsonResponse
    {
        $inputDatas['platform_sign'] = $this->currentPlatformEloq->sign;
        $this->model->fill($inputDatas);
        if (!$this->model->save()) {
            throw new \Exception('200500');
        }
        return msgOut(['title' => $inputDatas['title']]);
    }
}
