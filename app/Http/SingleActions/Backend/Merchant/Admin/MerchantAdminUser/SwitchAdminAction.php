<?php

namespace App\Http\SingleActions\Backend\Merchant\Admin\MerchantAdminUser;

use App\Http\Controllers\BackendApi\BackEndApiMainController;
use App\ModelFilters\Admin\MerchantAdminUserFilter;
use App\Models\Admin\MerchantAdminUser;
use Illuminate\Http\JsonResponse;

/**
 * 修改管理员状态
 */
class SwitchAdminAction
{

    /**
     * 后台管理员
     * @var object $model MerchantAdminUser
     */
    protected $model;

    /**
     * @param MerchantAdminUser $merchantAdminUser 代理商管理员Model.
     */
    public function __construct(MerchantAdminUser $merchantAdminUser)
    {
        $this->model = $merchantAdminUser;
    }

    /**
     * @param BackEndApiMainController $contll     Controller.
     * @param array                    $inputDatas 传递的参数.
     * @throws \Exception Exception.
     * @return JsonResponse
     */
    public function execute(BackEndApiMainController $contll, array $inputDatas): JsonResponse
    {
        $filterArr = [
                      'dataId'   => $inputDatas['id'],
                      'platform' => $contll->currentPlatformEloq->sign,
                     ];
        $adminUser = $this->model->filter($filterArr, MerchantAdminUserFilter::class)->first();
        if (!$adminUser) {
            throw new \Exception('201000');
        }
        $adminUser->status = $inputDatas['status'];
        if (!$adminUser->save()) {
            throw new \Exception('201004');
        }
        $msgOut = msgOut(true);
        return $msgOut;
    }
}
