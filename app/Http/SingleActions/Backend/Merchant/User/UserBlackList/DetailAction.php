<?php

namespace App\Http\SingleActions\Backend\Merchant\User\UserBlackList;

use App\Http\SingleActions\MainAction;
use App\Models\User\FrontendUsersBlackList;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * 黑名单详情
 */
class DetailAction extends MainAction
{

    /**
     * @var object
     */
    protected $model;

    /**
     * @param FrontendUsersBlackList $frontendUsersBlackList 用户黑名单Model.
     * @param Request                $request                Request.
     * @throws \Exception Exception.
     */
    public function __construct(FrontendUsersBlackList $frontendUsersBlackList, Request $request)
    {
        parent::__construct($request);
        $this->model = $frontendUsersBlackList;
    }

    /**
     * @param array $inputDatas 接收的参数.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(array $inputDatas): JsonResponse
    {
        $inputDatas['platformSign'] = $this->currentPlatformEloq->sign;

        $data = $this->model
            ->filter($inputDatas)
            ->select(
                [
                 'mobile',
                 'guid',
                 'account',
                 'register_time',
                 'last_login_time',
                 'created_at',
                 'remove_time',
                 'last_login_ip',
                 'remark',
                ],
            )
            ->paginate($this->perPage);
        return msgOut($data);
    }
}
