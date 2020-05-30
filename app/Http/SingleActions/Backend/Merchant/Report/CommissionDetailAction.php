<?php

namespace App\Http\SingleActions\Backend\Merchant\Report;

use App\Http\SingleActions\MainAction;
use App\Models\Report\ReportDayUserGameCommission;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * 游戏报表-列表
 */
class CommissionDetailAction extends MainAction
{

    /**
     * @var object
     */
    protected $model;

    /**
     * @param ReportDayUserGameCommission $reportDayUserGameCommission 游戏日报表Model.
     * @param Request                     $request                     Request.
     * @throws \Exception Exception.
     */
    public function __construct(
        ReportDayUserGameCommission $reportDayUserGameCommission,
        Request $request
    ) {
        parent::__construct($request);
        $this->model = $reportDayUserGameCommission;
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
                 'guid',
                 'game_sign',
                 'bet',
                 'effective_bet',
                 'commission',
                 'day',
                ],
            )->with('game:sign,name')
            ->orderBy('created_at', 'desc')
            ->paginate();
        return msgOut($result);
    }
}
