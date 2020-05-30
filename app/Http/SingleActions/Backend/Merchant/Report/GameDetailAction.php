<?php

namespace App\Http\SingleActions\Backend\Merchant\Report;

use App\Http\SingleActions\MainAction;
use App\Models\Game\GameReportDay;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

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
     * @param GameReportDay $gameReportDay 游戏日报表Model.
     * @param Request       $request       Request.
     * @throws \Exception Exception.
     */
    public function __construct(GameReportDay $gameReportDay, Request $request)
    {
        parent::__construct($request);
        $this->model = $gameReportDay;
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

        $result = $this->model
            ->filter($inputDatas)
            ->select(
                [
                 'day',
                 'game_name',
                 'bet_money',
                 'effective_bet',
                 'win_money',
                 'our_net_win',
                 'commission',
                ],
            )->orderBy('created_at', 'desc')
            ->paginate()
            ->toArray();

        $data = [];
        foreach ($result['data'] as $item) {
            $data[] = [
                       'day'           => $item['day'],
                       'game_name'     => $item['game_name'],
                       'effective_bet' => $item['effective_bet'],
                       'bet_money'     => $item['bet_money'],
                       'win_money'     => $item['win_money'],
                       'tax'           => $item['our_net_win'],
                       'commission'    => $item['commission'],
                      ];
        }//end foreach
        
        $result['data'] = $data;
        return msgOut($result);
    }
}
