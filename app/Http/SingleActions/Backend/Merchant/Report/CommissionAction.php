<?php

namespace App\Http\SingleActions\Backend\Merchant\Report;

use App\Http\SingleActions\MainAction;
use App\Models\Report\ReportDayUserRebate;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

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
     * @param ReportDayUserRebate $reportDayUserRebate 会员洗码日报表Model.
     * @param Request             $request             Request.
     * @throws \Exception Exception.
     */
    public function __construct(ReportDayUserRebate $reportDayUserRebate, Request $request)
    {
        parent::__construct($request);
        $this->model = $reportDayUserRebate;
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
                 'mobile',
                 'guid',
                 'game_vendor_sign',
                 'bet',
                 'effective_bet',
                 'rebate',
                 'day',
                ],
            )->with('gameVendor:sign,name')
            ->orderBy('created_at', 'desc')
            ->paginate();
        return msgOut($result);
    }
}
