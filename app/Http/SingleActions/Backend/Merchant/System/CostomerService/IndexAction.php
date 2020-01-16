<?php

namespace App\Http\SingleActions\Backend\Merchant\System\CostomerService;

use App\Http\Controllers\BackendApi\BackEndApiMainController;
use App\ModelFilters\System\SystemCostomerServiceFilter;
use App\Models\Systems\SystemCostomerService;
use Illuminate\Http\JsonResponse;

/**
 * 客服设置-列表
 */
class IndexAction
{

    /**
     * @var object
     */
    protected $model;

    /**
     * @param SystemCostomerService $systemCostomerService 洗码Model.
     */
    public function __construct(SystemCostomerService $systemCostomerService)
    {
        $this->model = $systemCostomerService;
    }

    /**
     * @param BackEndApiMainController $contll     Controller.
     * @param array                    $inputDatas 接收的参数.
     * @return JsonResponse
     */
    public function execute(BackEndApiMainController $contll, array $inputDatas): JsonResponse
    {
        $inputDatas['sign'] = $contll->currentPlatformEloq->sign;
        $data               = $this->model
            ->filter($inputDatas, SystemCostomerServiceFilter::class)
            ->get()
            ->toArray();
        $msgOut             = msgOut($data);
        return $msgOut;
    }
}
