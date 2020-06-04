<?php

namespace App\Http\SingleActions\Frontend\Common\AccountManagement;

use App\Http\SingleActions\MainAction;
use App\Models\Game\GameProject;
use App\Models\Order\UsersRechargeOrder;
use App\Models\User\FrontendUsersAccountsReport;
use App\Models\User\FrontendUsersAccountsType;
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
        $this->filterDatas = [
                              'created_at'        => $inputDatas['created_at'] ?? [],
                              'their_create_time' => $inputDatas['their_create_time'] ?? [],
                              'user_id'           => $this->user->id,
                             ];
        $data              = $this->_getReport($inputDatas['type']);
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
                $data = $this->_getWithdrawReport();
                break;
            case 4:
                $data = $this->_getGameReport();
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
        $this->filterDatas['frontend_display'] = FrontendUsersAccountsType::FRONTEND_DISPLAY_YES;
        return $this->model
            ->filter($this->filterDatas)
            ->select(['serial_number', 'in_out', 'amount', 'type_name', 'type_sign', 'balance', 'created_at'])
            ->orderBy('created_at', 'desc')
            ->paginate()
            ->toArray();
    }

    /**
     * 充值记录
     * @return mixed[]
     */
    private function _getRechargeReport(): array
    {
        return UsersRechargeOrder::filter($this->filterDatas)
            ->select(['order_no', 'money', 'arrive_money', 'recharge_status', 'status', 'created_at'])
            ->orderBy('created_at', 'desc')
            ->paginate($this->pageSize)
            ->toArray();
    }

    /**
     * 提现记录
     * @return mixed[]
     */
    private function _getWithdrawReport(): array
    {
        return UsersWithdrawOrder::filter($this->filterDatas)
            ->select(['order_no', 'amount', 'amount_received', 'account_type', 'status', 'created_at'])
            ->orderBy('created_at', 'desc')
            ->paginate($this->pageSize)
            ->toArray();
    }

    /**
     * 投注记录
     * @return mixed[]
     */
    private function _getGameReport(): array
    {
        return GameProject::filter($this->filterDatas)
            ->select(['game_vendor_sign', 'game_sign', 'bet_money', 'status', 'their_create_time'])
            ->with(['game:name,sign', 'gameVendor:name,sign'])
            ->orderBy('created_at', 'desc')
            ->paginate($this->pageSize)
            ->toArray();
    }
}
