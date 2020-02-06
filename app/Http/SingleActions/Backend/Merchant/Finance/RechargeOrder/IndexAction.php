<?php

namespace App\Http\SingleActions\Backend\Merchant\Finance\RechargeOrder;

use App\ModelFilters\Order\UsersRechargeOrderFilter;
use Illuminate\Http\JsonResponse;

/**
 * Class IndexAction
 * @package App\Http\SingleActions\Backend\Merchant\Finance\RechargeOrder
 */
class IndexAction extends BaseAction
{

    /**
     * @var object $model
     */
    protected $model;

    /**
     * @param array $inputDatas InputDatas.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(array $inputDatas): JsonResponse
    {
        $inputDatas['platform_sign'] = $this->currentPlatformEloq->sign;
        $pageSize                    = $this->model::getPageSize();
        $data                        = $this->model::with(
            [
             'user:id,mobile,guid,parent_id,is_tester',
             'user.parent:id,mobile,guid',
             'admin:id,name',
            ],
        )->filter($inputDatas, UsersRechargeOrderFilter::class)->select(
            [
             'id',
             'user_id',
             'admin_id',
             'is_online',
             'order_no',
             'platform_no',
             'snap_merchant_no',
             'snap_merchant_code',
             'snap_merchant',
             'snap_merchant',
             'snap_finance_type',
             'snap_account',
             'money',
             'arrive_money',
             'status',
             'created_at',
             'updated_at',
            ],
        )->paginate($pageSize);
        $msgOut                      = msgOut($data);
        return $msgOut;
    }
}
