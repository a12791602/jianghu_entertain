<?php

namespace App\Http\SingleActions\Frontend\Common\FrontendUser;

use App\Http\SingleActions\MainAction;
use App\Models\Report\ReportDayUser;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class UserReportAction
 * @package App\Http\SingleActions\Common\FrontendUser
 */
class UserReportAction extends MainAction
{

    /**
     * @var object
     */
    protected $model;
    
     /**
      * MainAction constructor.
      * @param ReportDayUser $reportDayUser 用户日报表.
      * @param Request       $request       Request.
      * @throws \Exception Exception.
      */
    public function __construct(ReportDayUser $reportDayUser, Request $request)
    {
        parent::__construct($request);
        $this->model = $reportDayUser;
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
        $inputDatas['guid']          = $this->user->guid;
        $inputDatas['platform_sign'] = $this->currentPlatformEloq->sign;
        $result                      = $this->model
            ->select(
                [
                 'bet_sum',
                 'effective_bet_sum',
                 'reduced_sum',
                 'commission',
                 'game_win_sum',
                 'day',
                ],
            )
            ->filter($inputDatas)
            ->orderBy('day', 'desc')
            ->paginate();
        return msgOut($result);
    }
}
