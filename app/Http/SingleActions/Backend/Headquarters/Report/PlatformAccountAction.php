<?php

namespace App\Http\SingleActions\Backend\Headquarters\Report;

use App\Http\SingleActions\MainAction;
use App\Models\Systems\SystemPlatformReportDay;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

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
     * @param SystemPlatformReportDay $systemPlatformReportDay 游戏报表Model.
     * @param Request                 $request                 Request.
     * @throws \Exception Exception.
     */
    public function __construct(SystemPlatformReportDay $systemPlatformReportDay, Request $request)
    {
        parent::__construct($request);
        $this->model = $systemPlatformReportDay;
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
                 'platform_sign',
                 'recharge_sum',
                 'withdraw_sum',
                 'reduced_sum',
                 'activity_sum',
                 'day',
                ],
            )->with('platform:sign,cn_name')
            ->filter($inputDatas)
            ->orderBy('created_at', 'desc')
            ->paginate();
        return msgOut($result);
    }
}
