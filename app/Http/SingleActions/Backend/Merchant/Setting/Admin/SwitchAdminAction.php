<?php

namespace App\Http\SingleActions\Backend\Merchant\Setting\Admin;

use App\Http\SingleActions\MainAction;
use App\ModelFilters\Admin\MerchantAdminUserFilter;
use App\Models\Admin\MerchantAdminUser;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * 修改管理员状态
 */
class SwitchAdminAction extends MainAction
{

    /**
     * 后台管理员
     * @var object $model MerchantAdminUser
     */
    protected $model;

    /**
     * @param MerchantAdminUser $merchantAdminUser 代理商管理员Model.
     * @param Request           $request           Request.
     * @throws \Exception Exception.
     */
    public function __construct(MerchantAdminUser $merchantAdminUser, Request $request)
    {
        parent::__construct($request);
        $this->model = $merchantAdminUser;
    }

    /**
     * @param array $inputDatas 传递的参数.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(array $inputDatas): JsonResponse
    {
        $filterArr = [
                      'dataId'   => $inputDatas['id'],
                      'platform' => $this->currentPlatformEloq->sign,
                     ];
        $adminUser = $this->model->filter($filterArr, MerchantAdminUserFilter::class)->first();
        if (!$adminUser) {
            throw new \Exception('201000');
        }
        $adminUser->status = $inputDatas['status'];
        if (!$adminUser->save()) {
            throw new \Exception('201004');
        }
        $msgOut = msgOut();
        return $msgOut;
    }
}
