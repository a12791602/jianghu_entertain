<?php

namespace App\Http\SingleActions\Backend\Merchant\System\CostomerService;

use App\Http\Controllers\BackendApi\BackEndApiMainController;
use App\ModelFilters\System\SystemCostomerServiceFilter;
use App\Models\Systems\SystemCostomerService;
use Illuminate\Http\JsonResponse;

/**
 * 客服设置-删除
 */
class DeleteAction
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
     * @throws \Exception Exception.
     * @return JsonResponse
     */
    public function execute(BackEndApiMainController $contll, array $inputDatas): JsonResponse
    {
        $filterArr       = [
                            'dataId' => $inputDatas['id'],
                            'sign'   => $contll->currentPlatformEloq->sign,
                           ];
        $costomerService = $this->model
            ->filter($filterArr, SystemCostomerServiceFilter::class)
            ->first();
        if (!$costomerService) {
            throw new \Exception('201201');
        }

        if (!$costomerService->delete()) {
            throw new \Exception('201203');
        }
        $msgOut = msgOut();
        return $msgOut;
    }
}
