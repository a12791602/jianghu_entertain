<?php

namespace App\Http\SingleActions\Backend\Merchant\System\CostomerService;

use App\Http\SingleActions\MainAction;
use App\Models\Systems\SystemCostomerService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * 客服设置-添加
 */
class DoAddAction extends MainAction
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
        $inputDatas['platform_sign'] = $this->currentPlatformEloq->sign;
        $this->model->fill($inputDatas);
        if (!$this->model->save()) {
            throw new \Exception('201200');
        }
        $msgOut = msgOut();
        return $msgOut;
    }
}
