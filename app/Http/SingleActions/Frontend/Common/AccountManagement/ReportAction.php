<?php

namespace App\Http\SingleActions\Frontend\Common\AccountManagement;

use App\Http\SingleActions\MainAction;
use App\ModelFilters\Order\UsersRechargeOrderFilter;
use App\ModelFilters\User\FrontendUsersAccountsReportFilter;
use App\Models\Order\UsersRechargeOrder;
use App\Models\User\FrontendUsersAccountsReport;
use App\Models\User\UsersWithdrawOrder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class report action.
 */
class ReportAction extends MainAction
{

    /**
     * @var FrontendUsersAccountsReport
     */
    protected $model;

    /**
     * @var array
     */
    protected $filterDatas;

    /**
     * @var integer
     */
    protected $pageSize = 25;

    /**
     * @param Request                     $request                     Request.
     * @param FrontendUsersAccountsReport $frontendUsersAccountsReport FrontendUsersAccountsReport.
     */
    public function __construct(
        Request $request,
        FrontendUsersAccountsReport $frontendUsersAccountsReport
    ) {
        parent::__construct($request);
        $this->model = $frontendUsersAccountsReport;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  array $inputDatas 传递的参数.
     * @throws \Exception Exception.
     * @return JsonResponse
     */
    public function execute(array $inputDatas): JsonResponse
    {
        if (isset($inputDatas['pageSize'])) {
            $this->pageSize = $inputDatas['pageSize'];
        }
        $this->filterDatas           = $inputDatas;
        $this->filterDatas['userId'] = $this->user->id;
        $data                        = $this->_getReport($inputDatas['type']);
        return msgOut($data);
    }

    /**
     * @param integer $type 报表类型1账变明细2充值记录3提现记录.
     * @return mixed[]
     */
    private function _getReport(int $type): array
    {
        $data = [];
        switch ($type) {
            case 1:
                $data = $this->_getAccountReport();
                break;
            case 2:
                $data = $this->_getRechargeReport();
                break;
            case 3:
                $data = $this->_getwithdrawReport();
                break;
        }
        return $data;
    }

    /**
     * 账变记录
     * @return mixed[]
     */
    private function _getAccountReport(): array
    {
        
        $this->filterDatas['frozenTypeIn'] = [
                                              $this->model::FROZEN_STATUS_NOT,
                                              $this->model::FROZEN_STATUS_OUT,
                                              $this->model::FROZEN_STATUS_BACK,
                                             ];
        return $this->model
            ->filter($this->filterDatas, FrontendUsersAccountsReportFilter::class)
            ->select(['serial_number', 'in_out', 'amount', 'type_name', 'type_sign', 'balance', 'created_at'])
            ->paginate($this->pageSize)
            ->toArray();
    }

    /**
     * 充值记录
     * @return mixed[]
     */
    private function _getRechargeReport(): array
    {
        return UsersRechargeOrder::filter($this->filterDatas, UsersRechargeOrderFilter::class)
            ->select(['order_no', 'money', 'arrive_money', 'recharge_status', 'status', 'created_at'])
            ->paginate($this->pageSize)
            ->toArray();
    }

    /**
     * 提现记录
     * @return mixed[]
     */
    private function _getwithdrawReport(): array
    {
        return UsersWithdrawOrder::filter($this->filterDatas, FrontendUsersAccountsReportFilter::class)
            ->select(['order_no', 'amount', 'amount_received', 'account_type', 'status', 'created_at'])
            ->paginate($this->pageSize)
            ->toArray();
    }
}
