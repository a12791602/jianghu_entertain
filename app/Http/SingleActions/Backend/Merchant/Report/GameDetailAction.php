<?php

namespace App\Http\SingleActions\Backend\Merchant\Report;

use App\Http\Resources\Backend\Merchant\Report\GameDetailResource;
use App\Http\SingleActions\MainAction;
use App\Models\Report\ReportDayUserGame;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * 游戏报表-详情
 */
class GameDetailAction extends MainAction
{

    /**
     * @var object
     */
    protected $model;

    /**
     * @param ReportDayUserGame $reportDayUserGame 游戏日报表Model.
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

        $select = 'day as rDay,game_sign,sum(bet_money) as bet_money,sum(effective_bet) as effective_bet,
        sum(win_money) as win_money,sum(our_net_win) as our_net_win,sum(commission) as commission';
        $result = $this->model
            ->filter($inputDatas)
            ->select(DB::raw($select))
            ->with('game:sign,name')
            ->groupBy('game_sign', 'day')
            ->orderBy('day', 'desc')
            ->paginate();
        return msgOut(GameDetailResource::collection($result));
    }
}
