<?php

namespace App\Http\SingleActions\Frontend\Common\Commission;

use App\Http\SingleActions\MainAction;
use App\Models\Report\ReportDayUserCommission;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class rebate action.
 */
class RebateAction extends MainAction
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
        $inputDatas['guid']          = $this->user->guid;
        $userPercent                 = $this->model->filter($inputDatas)
        ->select(
            [
             'game_vendor_sign',
             'effective_bet',
             'rebate',
             'percent',
             'day',
            ],
        )->with('gameVendor:sign,name');

        $rebateSum           = $userPercent->sum('rebate');
        $userPercentPaginate = $userPercent->paginate();
        $rebateCurrent       = $userPercentPaginate->sum('rebate');
        $result              = $userPercentPaginate->toArray();
        $data                = [];
        foreach ($result['data'] as $item) {
            $data[] = [
                       'game_vendor_name' => $item['game_vendor']['name'] ?? '',
                       'effective_bet'    => $item['effective_bet'],
                       'rebate'           => $item['rebate'],
                       'percent'          => sprintf('%.2f', $item['percent']) . '%',
                       'day'              => $item['day'],
                      ];
        }
        $result['rebate_sum']     = (float) $rebateSum;
        $result['rebate_current'] = (float) $rebateCurrent;
        $result['data']           = $data;
        return msgOut($result);
    }
}
