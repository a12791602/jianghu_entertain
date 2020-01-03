<?php

namespace App\Http\SingleActions\Backend\Headquarters\DeveloperUsage\Merchant\Route;

use App\Models\DeveloperUsage\Merchant\SystemRoutesMerchant;
use Illuminate\Http\JsonResponse;

/**
 * 路由-添加
 */
class DoAddAction
{

    /**
     * @var SystemRoutesMerchant
     */
    protected $model;

    /**
     * @param SystemRoutesMerchant $systemRoutesMerchant Model.
     */
    public function __construct(SystemRoutesMerchant $systemRoutesMerchant)
    {
        $this->model = $systemRoutesMerchant;
    }

    /**
     * @param  array $inputDatas 接收的数据.
     * @throws \Exception Exception.
     * @return JsonResponse
     */
    public function execute(array $inputDatas): JsonResponse
    {
        $this->model->fill($inputDatas);
        if (!$this->model->save()) {
            throw new \Exception('302300');
        }
        $msgOut = msgOut(true, ['title' => $this->model->title]);
        return $msgOut;
    }
}
