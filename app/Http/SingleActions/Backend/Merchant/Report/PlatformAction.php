<?php

namespace App\Http\SingleActions\Backend\Merchant\Report;

use App\Http\SingleActions\MainAction;
use App\Models\Report\ReportDayPlatform;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * 公司报表-列表
 */
class PlatformAction extends MainAction
{

    /**
     * @var object
     */
    protected $model;

    /**
     * @param ReportDayPlatform $reportDayPlatform 公司日报表Model.
     * @param Request           $request           Request.
     * @throws \Exception Exception.
     */
    public function __construct(ReportDayPlatform $reportDayPlatform, Request $request)
    {
        parent::__construct($request);
        $this->model = $reportDayPlatform;
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
                 'recharge_sum',
                 'withdraw_sum',
                 'reduced_sum',
                 'activity_sum',
                 'day',
                ],
            )->orderBy('created_at', 'desc')
            ->paginate();
        return msgOut($result);
    }
}
