<?php

namespace App\Http\SingleActions\Backend\Headquarters\Report;

use App\Http\SingleActions\MainAction;
use App\Models\Report\ReportDayUserGame;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

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
        $result = $this->model
            ->select(
                [
                 'platform_sign',
                 'game_vendor_name',
                 'bet_money',
                 'effective_bet',
                 'win_money',
                 'our_net_win',
                 'day',
                ],
            )->with('platform:sign,cn_name')
            ->filter($inputDatas)
            ->orderBy('created_at', 'desc')
            ->paginate()
            ->toArray();
        return msgOut($result);
    }
}
