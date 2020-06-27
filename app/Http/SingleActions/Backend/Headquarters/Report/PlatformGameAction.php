<?php

namespace App\Http\SingleActions\Backend\Headquarters\Report;

use App\Http\Resources\Backend\Headquarters\Report\PlatformGameResource;
use App\Http\SingleActions\MainAction;
use App\Models\Report\ReportDayUserGame;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * 厅主游戏报表
 */
class PlatformGameAction extends MainAction
{

    /**
     * @var object
     */
    protected $model;

    /**
     * @param ReportDayUserGame $reportDayUserGame 游戏报表Model.
     * @param Request           $request           Request.
     * @throws \Exception Exception.
     */
    public function __construct(
        ReportDayUserGame $reportDayUserGame,
        Request $request
    ) {
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

        $select = 'day as rDay,platform_sign,game_vendor_sign,sum(bet_money) as bet_money,
        sum(effective_bet) as effective_bet,sum(win_money) as win_money,sum(our_net_win) as our_net_win,
        sum(commission) as commission,sum(rebate) as rebate';
        $result = $this->model
            ->filter($inputDatas)
            ->select(DB::raw($select))
            ->with(
                [
                 'gameVendor:sign,name',
                 'platform:sign,cn_name',
                ],
            )
            ->groupBy('game_vendor_sign', 'platform_sign', 'day')
            ->orderBy('day', 'desc')
            ->paginate();
        return msgOut(PlatformGameResource::collection($result));
    }
}
