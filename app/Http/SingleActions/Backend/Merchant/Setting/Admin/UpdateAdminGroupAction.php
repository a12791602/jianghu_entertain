<?php

namespace App\Http\SingleActions\Backend\Merchant\Setting\Admin;

use App\Http\SingleActions\MainAction;
use App\Models\Admin\MerchantAdminAccessGroup;
use App\Models\Admin\MerchantAdminUser;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class for update admin group action.
 */
class UpdateAdminGroupAction extends MainAction
{

    /**
     * @var object
     */
    protected $model;

    /**
     * @param MerchantAdminUser $merchantAdminUser MerchantAdminUser.
     * @param Request           $request           Request.
     * @throws \Exception Exception.
     */
    public function __construct(MerchantAdminUser $merchantAdminUser, Request $request)
    {
        parent::__construct($request);
        $this->model = $merchantAdminUser;
    }

    /**
     * 修改管理员的归属组
     *
     * @param array $inputDatas 传递的参数.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(array $inputDatas): JsonResponse
    {
        //验证管理员
        $AdminUserEloq = $this->model->find($inputDatas['id']);
        if ($AdminUserEloq === null) {
            throw new \Exception('300701');
        }
        if ($AdminUserEloq->accessGroup->is_super === 1) {
            throw new \Exception('300702');
        }
        //更改的权限组是否合法
        $filterArr            = [
                                 'platform' => $this->currentPlatformEloq->sign,
                                 'super'    => MerchantAdminAccessGroup::NO_SUPER,
                                ];
        $platformAdminGroupId = MerchantAdminAccessGroup::filter($filterArr)
                                    ->pluck('id')
                                    ->toArray();
        if (!in_array($inputDatas['group_id'], $platformAdminGroupId)) {
            throw new \Exception('300700');
        }
        //更改组
        $AdminUserEloq->group_id = $inputDatas['group_id'];
        $AdminUserEloq->save();
        return msgOut($AdminUserEloq->toArray());
    }
}
