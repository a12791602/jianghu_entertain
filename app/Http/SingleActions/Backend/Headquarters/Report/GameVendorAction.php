<?php

namespace App\Http\SingleActions\Backend\Headquarters\Report;

use App\Http\SingleActions\MainAction;
use App\Models\Report\ReportDayGameVendor;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * 第三方游戏报表-列表
 */
class GameVendorAction extends MainAction
{

    /**
     * @var object
     */
    protected $model;

    /**
     * @param ReportDayGameVendor $reportDayGameVendor 游戏注单Model.
     * @param Request             $request             Request.
     * @throws \Exception Exception.
     */
    public function __construct(ReportDayGameVendor $reportDayGameVendor, Request $request)
    {
        parent::__construct($request);
        $this->model = $reportDayGameVendor;
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
                 'game_vendor_sign',
                 'bet',
                 'win_money',
                 'tax',
                 'effective_bet',
                 'rebate',
                 'commission',
                 'day',
                ],
            )->with('gameVendor:sign,name')
            ->filter($inputDatas)
            ->orderBy('created_at', 'desc')
            ->paginate()
            ->toArray();
        return msgOut($result);
    }
}
