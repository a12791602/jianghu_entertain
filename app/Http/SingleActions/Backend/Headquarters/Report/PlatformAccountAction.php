<?php

namespace App\Http\SingleActions\Backend\Headquarters\Report;

use App\Http\Resources\Backend\Headquarters\Report\PlatformAccountResource;
use App\Http\SingleActions\MainAction;
use App\Models\Report\ReportDayUser;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * 厅主充提报表
 */
class PlatformAccountAction extends MainAction
{

    /**
     * @var object
     */
    protected $model;

    /**
     * @param ReportDayUser $reportDayUser 用户报表Model.
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
        $select = 'day as rDay,platform_sign,sum(recharge_sum) as recharge_sum,
        sum(withdraw_sum) as withdraw_sum,sum(reduced_sum) as reduced_sum,sum(activity_sum) as activity_sum';
        $result = $this->model
            ->filter($inputDatas)
            ->select(DB::raw($select))
            ->with('platform:sign,cn_name')
            ->groupBy('platform_sign', 'day')
            ->orderBy('day', 'desc')
            ->paginate();
        return msgOut(PlatformAccountResource::collection($result));
    }
}
