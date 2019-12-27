<?php

namespace App\Http\SingleActions\Backend\Merchant\System\CostomerService;

use App\Http\Controllers\BackendApi\BackEndApiMainController;
use App\Models\Systems\SystemCostomerService;
use Illuminate\Http\JsonResponse;

/**
 * 客服设置-添加
 */
class DoAddAction
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
        $inputDatas['sign'] = $contll->currentPlatformEloq->sign;
        $this->model->fill($inputDatas);
        if (!$this->model->save()) {
            throw new \Exception('201200');
        }
        $msgOut = msgOut(true);
        return $msgOut;
    }
}
