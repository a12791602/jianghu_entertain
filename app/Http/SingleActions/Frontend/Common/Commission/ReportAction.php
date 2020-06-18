<?php

namespace App\Http\SingleActions\Frontend\Common\Commission;

use App\Http\SingleActions\MainAction;
use App\Models\Report\ReportDayUserCommission;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class report action.
 */
class ReportAction extends MainAction
{

    /**
     * @var ReportDayUserCommission
     */
    protected $model;

    /**
     * @param Request                 $request                 Request.
     * @param ReportDayUserCommission $reportDayUserCommission ReportDayUserCommission.
     */
    public function __construct(
        Request $request,
        ReportDayUserCommission $reportDayUserCommission
    ) {
        parent::__construct($request);
        $this->model = $reportDayUserCommission;
    }

    /**
     * @param  array $inputDatas 传递的参数.
     * @throws \Exception Exception.
     * @return JsonResponse
     */
    public function execute(array $inputDatas): JsonResponse
    {
        if (isset($inputDatas['pageSize'])) {
            $this->model->setPerPage($inputDatas['pageSize']);
        }
        $inputDatas['platform_sign'] = getCurrentPlatformSign();
        $inputDatas['agent']         = $this->user->id;
        $commission                  = $this->model->filter($inputDatas)
        ->select(
            [
             'mobile',
             'guid',
             'win_lose',
             'commission',
             'level',
             'day',
            ],
        );

        $commissionSum                = $commission->sum('commission');
        $commissionPaginate           = $commission->paginate();
        $commissionCurrentSum         = $commissionPaginate->sum('commission');
        $result                       = $commissionPaginate->toArray();
        $result['commission_sum']     = floatDC($commissionSum);
        $result['commission_current'] = floatDC($commissionCurrentSum);
        return msgOut($result);
    }
}
