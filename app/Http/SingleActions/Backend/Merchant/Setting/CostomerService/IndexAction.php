<?php

namespace App\Http\SingleActions\Backend\Merchant\Setting\CostomerService;

use App\Http\SingleActions\MainAction;
use App\ModelFilters\System\SystemCostomerServiceFilter;
use App\Models\Systems\SystemCostomerService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * 客服设置-列表
 */
class IndexAction extends MainAction
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
        $inputDatas['sign'] = $this->currentPlatformEloq->sign;
        $data               = $this->model
            ->filter($inputDatas, SystemCostomerServiceFilter::class)
            ->get()
            ->toArray();
        return msgOut($data);
    }
}
