<?php

namespace App\Http\SingleActions\Backend\Merchant\User\UsersTag;

use App\Http\SingleActions\MainAction;
use App\Models\User\UsersTag;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * 用户标签列表
 */
class IndexAction extends MainAction
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
     * @param array $inputDatas 接收的参数.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(array $inputDatas): JsonResponse
    {
        if (isset($inputDatas['pageSize'])) {
            $this->model->setPerPage($inputDatas['pageSize']);
        }
        $sign      = $this->currentPlatformEloq->sign;
        $filterArr = ['platformSign' => $sign];
        $data      = $this->model
                          ->filter($filterArr)
                          ->select('id', 'title', 'no_withdraw', 'no_login', 'no_play', 'no_promote', 'created_at')
                          ->paginate();
        return msgOut($data);
    }
}
