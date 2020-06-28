<?php

namespace App\Http\SingleActions\Frontend\Common\Commission;

use App\Http\SingleActions\MainAction;
use App\Models\Report\ReportDayUserGame;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * Class rebate action.
 */
class RebateAction extends MainAction
{

    /**
     * @var ReportDayUserGame
     */
    protected $model;

    /**
     * @param Request           $request           Request.
     * @param ReportDayUserGame $reportDayUserGame ReportDayUserGame.
     */
    public function __construct(
        Request $request,
        ReportDayUserGame $reportDayUserGame
    ) {
        parent::__construct($request);
        $this->model = $reportDayUserGame;
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

        $select            = 'day as rDay,game_vendor_sign,sum(effective_bet) as effective_bet,sum(rebate) as rebate';
        $reportDayUserGame = $this->model
            ->filter($inputDatas)
            ->select(DB::raw($select))
            ->with('gameVendor:sign,name')
            ->groupBy('game_vendor_sign', 'day')
            ->orderBy('day', 'desc');
        $rebateSum         = $reportDayUserGame->sum('rebate');
        $resultPaginate    = $reportDayUserGame->paginate();
        $rebateCurrent     = $resultPaginate->sum('rebate');
        $resultArr         = $resultPaginate->toArray();
        $data              = [];
        foreach ($resultArr['data'] as $item) {
            $data[] = [
                       'day'              => $item['rDay'],
                       'game_vendor_name' => $item['gameVendor']['name'] ?? '',
                       'effective_bet'    => floatDC($item['effective_bet']),
                       'rebate'           => floatDC($item['rebate']),
                       'percent'          => $item['rebate'] / $item['effective_bet'] * 100 . '%', //洗码百分比
                      ];
        }
        $resultArr['rebate_current'] = floatDC($rebateCurrent);
        $resultArr['rebate_sum']     = floatDC($rebateSum);
        $resultArr['data']           = $data;
        return msgOut($resultArr);
    }
}
