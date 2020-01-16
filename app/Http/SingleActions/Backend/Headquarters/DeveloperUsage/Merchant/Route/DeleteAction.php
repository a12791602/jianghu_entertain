<?php

namespace App\Http\SingleActions\Backend\Headquarters\DeveloperUsage\Merchant\Route;

use App\Models\DeveloperUsage\Merchant\SystemRoutesMerchant;
use Illuminate\Http\JsonResponse;

/**
 * 路由-删除
 */
class DeleteAction
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
        $routeEloq = $this->model->find($inputDatas['id']);
        if (!$routeEloq) {
            throw new \Exception('302301');
        }
        $title = $routeEloq->title;
        if (!$routeEloq->delete()) {
            throw new \Exception('302303');
        }
        $msgOut = msgOut(['title' => $title]);
        return $msgOut;
    }
}
