<?php

namespace App\Http\SingleActions\Backend\Merchant\System\CostomerService;

use App\Http\SingleActions\MainAction;
use App\ModelFilters\System\SystemCostomerServiceFilter;
use App\Models\Systems\SystemCostomerService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * 客服设置-编辑
 */
class EditAction extends MainAction
{

    /**
     * @var object
     */
    protected $model;

    /**
     * @param SystemCostomerService $systemCostomerService 洗码Model.
     * @param Request               $request               Request.
     * @throws \Exception Exception.
     */
    public function __construct(SystemCostomerService $systemCostomerService, Request $request)
    {
        parent::__construct($request);
        $this->model = $systemCostomerService;
    }

    /**
     * @param array $inputDatas 接收的参数.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(array $inputDatas): JsonResponse
    {
        $filterArr       = [
                            'dataId' => $inputDatas['id'],
                            'sign'   => $this->currentPlatformEloq->sign,
                           ];
        $costomerService = $this->model
            ->filter($filterArr, SystemCostomerServiceFilter::class)
            ->first();
        if (!$costomerService) {
            throw new \Exception('201201');
        }

        $costomerService->fill($inputDatas);
        if (!$costomerService->save()) {
            throw new \Exception('201202');
        }
        $msgOut = msgOut();
        return $msgOut;
    }
}
