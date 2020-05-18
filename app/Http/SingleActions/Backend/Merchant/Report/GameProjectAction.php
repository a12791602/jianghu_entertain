<?php

namespace App\Http\SingleActions\Backend\Merchant\Report;

use App\Http\SingleActions\MainAction;
use App\Models\Game\GameProject;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * 平台注单-列表
 */
class GameProjectAction extends MainAction
{

    /**
     * @var object
     */
    protected $model;

    /**
     * @param GameProject $gameProject 游戏注单Model.
     * @param Request     $request     Request.
     * @throws \Exception Exception.
     */
    public function __construct(GameProject $gameProject, Request $request)
    {
        parent::__construct($request);
        $this->model = $gameProject;
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
        $result                      = $this->model
            ->select(
                [
                 'serial_number',
                 'guid',
                 'user_id',
                 'bet_money',
                 'their_notifyId',
                 'our_win_money',
                 'win_money',
                 'status',
                 'their_create_time',
                 'delivery_time',
                 'user_id',
                 'game_sign',
                 'game_vendor_sign',
                 'vip_level_id',
                 'created_at',
                 'username',
                 'ip',
                ],
            )->with(
                [
                 'user:id,mobile',
                 'userLevel:id,name',
                 'game:sign,name',
                 'gameVendor:sign,name',
                ],
            )
            ->filter($inputDatas)
            ->paginate()
            ->toArray();

        $result = $this->_dataHandle($result);
        return msgOut($result);
    }

    /**
     * @param  array $result 需要处理的数据.
     * @return mixed[]
     */
    private function _dataHandle(array $result): array
    {
        $data = [];
        foreach ($result['data'] as $project) {
            $effectiveBet = $project['bet_money'] - $project['win_money'];
            $effectiveBet = $effectiveBet < 0 ? 0 : $effectiveBet;
            $data[]       = [
                             'serial_number'     => $project['serial_number'],
                             'mobile'            => $project['user']['mobile'] ?? '',
                             'guid'              => $project['guid'],
                             'level_name'        => $project['user_level']['name'] ?? '',
                             'game_vendor'       => $project['game_vendor']['name'] ?? '',
                             'game_name'         => $project['game']['name'] ?? '',
                             'bet_money'         => $project['bet_money'],
                             'win_money'         => $project['win_money'],
                             'effective_bet'     => $effectiveBet,
                             'charged_fees'      => $project['our_win_money'] ?? '--',
                             'status'            => $project['status'],
                             'their_create_time' => $project['their_create_time'],
                             'delivery_time'     => $project['delivery_time'],
                             'created_at'        => $project['created_at'],
                             'their_notifyId'    => $project['their_notifyId'],
                             'username'          => $project['username'],
                             'ip'                => $project['ip'],
                            ];
        }//end foreach
        $result['data'] = $data;
        return $result;
    }
}
