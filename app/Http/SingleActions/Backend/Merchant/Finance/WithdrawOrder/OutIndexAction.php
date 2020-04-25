<?php

namespace App\Http\SingleActions\Backend\Merchant\Finance\WithdrawOrder;

use App\Models\Notification\MerchantNotificationStatistic;
use App\Models\User\UsersWithdrawOrder;
use Illuminate\Http\JsonResponse;

/**
 * Class OutIndexAction
 * @package App\Http\SingleActions\Backend\Merchant\Finance\WithdrawOrder
 */
class OutIndexAction extends BaseAction
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
        merchantNotificationClear(MerchantNotificationStatistic::WITHDRAWAL_REVIEW);
        if (isset($inputDatas['pageSize'])) {
            $this->model->setPerPage($inputDatas['pageSize']);
        }
        $inputDatas['platform_sign'] = $this->currentPlatformEloq->sign;
        $returnField                 = $this->_getReturnField();
        $inputDatas['status_list']   = [
                                        UsersWithdrawOrder::STATUS_CHECK_PASS,
                                        UsersWithdrawOrder::STATUS_OUT_REFUSE,
                                        UsersWithdrawOrder::STATUS_OUT_SUCESS,
                                       ];
        $data                        = $this->model->with(
            [
             'user:id,mobile,guid,parent_id,is_tester',
             'admin:id,name',
             'reviewer:id,name',
             'user.parent:id,mobile,guid',
            ],
        )->filter($inputDatas)
        ->select($returnField)
        ->paginate();
        return msgOut($data);
    }

    /**
     * 获取返回给前端的字段.
     *
     * @return mixed[]
     */
    private function _getReturnField(): array
    {
        return [
                'id',
                'user_id',
                'reviewer_id',
                'admin_id',
                'order_no',
                'amount',
                'audit_fee',
                'amount_received',
                'handing_fee',
                'created_at',
                'review_at',
                'operation_at',
                'status',
                'before_balance',
                'month_total',
                'num_top_up',
                'num_withdrawal',
                'remark',
                'account_type',
                'account_snap',
               ];
    }
}
