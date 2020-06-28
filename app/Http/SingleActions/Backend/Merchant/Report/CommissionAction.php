<?php

namespace App\Http\SingleActions\Backend\Merchant\Report;

use App\Http\Resources\Backend\Merchant\Report\CommissionResource;
use App\Http\SingleActions\MainAction;
use App\Models\Report\ReportDayUserGame;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * 会员洗码-列表
 */
class CommissionAction extends MainAction
{

    /**
     * @var object
     */
    protected $model;

    /**
     * @param ReportDayUserGame $reportDayUserGame Model.
     * @param Request           $request           Request.
     * @throws \Exception Exception.
     */
    public function __construct(ReportDayUserGame $reportDayUserGame, Request $request)
    {
        parent::__construct($request);
        $this->model = $reportDayUserGame;
    }

    /**
     * @param array $inputDatas 接收的参数.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(array $inputDatas): JsonResponse
    {
        if (isset($inputDatas['pageSize'])) {
            $this->model->setPerPage($inputDatas['pageSize']);
        }
        $inputDatas['platform_sign'] = $this->currentPlatformEloq->sign;

        $select = 'day as rDay,game_vendor_sign,guid,mobile,sum(bet_money) as bet_money,
        sum(effective_bet) as effective_bet,sum(rebate) as rebate';
        $result = $this->model
            ->filter($inputDatas)
            ->select(DB::raw($select))
            ->with('gameVendor:sign,name')
            ->groupBy('guid', 'game_vendor_sign', 'day')
            ->orderBy('day', 'desc')
            ->paginate();
        return msgOut(CommissionResource::collection($result));
    }
}
