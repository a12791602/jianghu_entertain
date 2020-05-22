<?php

namespace App\Http\SingleActions\Backend\Merchant\Report;

use App\Http\SingleActions\MainAction;
use App\Models\User\UsersReportDay;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * 个人报表-列表
 */
class UserAction extends MainAction
{

    /**
     * @var object
     */
    protected $model;

    /**
     * @param UsersReportDay $usersReportDay 游戏日报表Model.
     * @param Request        $request        Request.
     * @throws \Exception Exception.
     */
    public function __construct(UsersReportDay $usersReportDay, Request $request)
    {
        parent::__construct($request);
        $this->model = $usersReportDay;
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
            ->filter($inputDatas)
            ->select(
                [
                 'day',
                 'mobile',
                 'guid',
                 'recharge_sum',
                 'recharge_num',
                 'withdraw_sum',
                 'withdraw_num',
                 'bet_sum',
                 'bet_num',
                 'reduced_sum',
                 'effective_bet_sum',
                 'commission',
                 'activity_sum',
                 'game_win_sum',
                 'real_win_lose',
                 'day',
                ],
            )->orderBy('day', 'desc')
            ->paginate()
            ->toArray();
        return msgOut($result);
    }
}
