<?php

namespace App\Http\SingleActions\Backend\Merchant\Admin\MerchantAdminUser;

use App\Http\Controllers\BackendApi\BackEndApiMainController;
use App\ModelFilters\Admin\MerchantAdminAccessGroupFilter;
use App\Models\Admin\MerchantAdminAccessGroup;
use App\Models\Admin\MerchantAdminUser;
use Illuminate\Http\JsonResponse;

/**
 * Class for update admin group action.
 */
class UpdateAdminGroupAction
{

    /**
     * @var object
     */
    protected $model;

    /**
     * @param MerchantAdminUser $merchantAdminUser MerchantAdminUser.
     */
    public function __construct(MerchantAdminUser $merchantAdminUser)
    {
        $this->model = $merchantAdminUser;
    }

    /**
     * 修改管理员的归属组
     *
     * @param  BackEndApiMainController $contll     Controller.
     * @param  array                    $inputDatas 传递的参数.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(BackEndApiMainController $contll, array $inputDatas): JsonResponse
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
            'platform' => $contll->currentPlatformEloq->sign,
            'super'    => MerchantAdminAccessGroup::NO_SUPER,
        ];
        $platformAdminGroupId = MerchantAdminAccessGroup::filter($filterArr, MerchantAdminAccessGroupFilter::class)
                                    ->pluck('id')
                                    ->toArray();
        if (!in_array($inputDatas['group_id'], $platformAdminGroupId)) {
            throw new \Exception('300700');
        }
        //更改组
        $AdminUserEloq->group_id = $inputDatas['group_id'];
        $AdminUserEloq->save();
        $msgOut = msgOut(true, $AdminUserEloq->toArray());
        return $msgOut;
    }
}
