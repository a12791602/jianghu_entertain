<?php

namespace App\Http\SingleActions\Frontend\Common\AccountManagement;

use App\Http\Resources\Frontend\FrontendUser\RechargeReportResource;
use App\Http\SingleActions\MainAction;
use App\Lib\Constant\JHHYCnst;
use App\Models\Game\GameProject;
use App\Models\User\FrontendUsersAccountsReport;
use App\Models\User\FrontendUsersAccountsType;
use App\Models\User\UsersRechargeOrder;
use App\Models\User\UsersWithdrawOrder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Redis;

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
     * @return mixed
     */
    private function _getReport(int $type)
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
     * @return LengthAwarePaginator
     */
    private function _getAccountReport(): LengthAwarePaginator
    {
        $this->filterDatas['frontend_display'] = FrontendUsersAccountsType::FRONTEND_DISPLAY_YES;
        return $this->model
            ->filter($this->filterDatas)
            ->select(['serial_number', 'in_out', 'amount', 'type_name', 'type_sign', 'balance', 'created_at'])
            ->orderBy('created_at', 'desc')
            ->paginate();
    }

    /**
     * 充值记录
     * @return AnonymousResourceCollection
     */
    private function _getRechargeReport(): AnonymousResourceCollection
    {
        $result = UsersRechargeOrder::filter($this->filterDatas)
            ->select(
                [
                 'order_no',
                 'money',
                 'arrive_money',
                 'arrived_at',
                 'status',
                 'finance_type_id',
                 'created_at',
                 'finance_channel_id',
                 'is_online',
                ],
            )->with('offlineInfo')
            ->orderBy('created_at', 'desc')
            ->get();

        $unconfirmed = $this->_topUpOrder()->sortByDesc('created_at')->where('user_id', $this->user->id);
        $unconfirmed->transform(
            static function ($item): UsersRechargeOrder {
                return $item->load('offlineInfo');
            },
        );
        $item       = collect($unconfirmed)->merge($result);
        $item_count = $item->count();
        $page       = request()->page ?? 1;
        $perPage    = request()->pageSize ?? JHHYCnst::PAGINATION_PER_PAGE;
        $order      = new LengthAwarePaginator($item->forPage($page, $perPage), $item_count, $perPage);
        return RechargeReportResource::collection($order);
    }

    /**
     * 提现记录
     * @return LengthAwarePaginator
     */
    private function _getWithdrawReport(): LengthAwarePaginator
    {
        return UsersWithdrawOrder::filter($this->filterDatas)
            ->select(['order_no', 'amount', 'amount_received', 'account_type', 'status', 'created_at'])
            ->orderBy('created_at', 'desc')
            ->paginate($this->perPage);
    }

    /**
     * 投注记录
     * @return LengthAwarePaginator
     */
    private function _getGameReport(): LengthAwarePaginator
    {
        return GameProject::filter($this->filterDatas)
            ->select(['game_vendor_sign', 'game_sign', 'bet_money', 'status', 'their_create_time'])
            ->with(['game:name,sign', 'gameVendor:name,sign'])
            ->orderBy('created_at', 'desc')
            ->paginate($this->perPage);
    }

    /**
     * 用户发起还未确定的订单
     * @return Collection
     */
    private function _topUpOrder(): Collection
    {
        $platform_sign = $this->currentPlatformEloq->sign;
        $cache         = Redis::connection();
        $order_key     = $platform_sign . ':frontend_user_' . $this->user->id . ':top_up_order:';
        $range_key     = $cache->keys($order_key . '*');
        $cache_prefix  = config('database.redis.options.prefix');
        return collect($range_key)->map(
            static function ($order_key) use ($cache, $cache_prefix): UsersRechargeOrder {
                $order_key = str_replace($cache_prefix, '', $order_key);
                $item      = $cache->get($order_key);
                return unserialize($item);
            },
        );
    }
}
