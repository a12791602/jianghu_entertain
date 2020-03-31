<?php

namespace App\Http\SingleActions\Backend\Merchant\User\FrontendUser;

use App\Http\Resources\Backend\Merchant\User\FrontendUser\DetailResource;
use App\Models\User\FrontendUser;
use Illuminate\Http\JsonResponse;

/**
 * 会员详情
 */
class DetailAction
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
        $data = $this->model->where('guid', $inputDatas['guid'])
            ->select(
                [
                 'id',
                 'mobile',
                 'parent_id',
                 'is_online',
                 'is_tester',
                 'guid',
                 'type',
                 'status',
                 'device_code',
                 'user_tag_id',
                 'register_ip',
                 'last_login_ip',
                 'last_login_time',
                 'created_at',
                ],
            )
            ->with(
                [
                 'userTag:id,title',
                 'specificInfo:user_id,level,total_members,nickname,register_type,total_members',
                 'account:user_id,balance',
                ],
            )
            ->first();
        return msgOut(DetailResource::make($data));
    }
}
