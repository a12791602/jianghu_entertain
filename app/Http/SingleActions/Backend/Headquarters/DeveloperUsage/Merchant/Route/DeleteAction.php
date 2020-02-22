<?php

namespace App\Http\SingleActions\Backend\Headquarters\DeveloperUsage\Merchant\Route;

use App\Http\SingleActions\MainAction;
use App\Models\DeveloperUsage\Merchant\SystemRoutesMerchant;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * 路由-删除
 */
class DeleteAction extends MainAction
{

    /**
     * @var SystemRoutesMerchant
     */
    protected $model;

    /**
     * @param Request              $request              Request.
     * @param SystemRoutesMerchant $systemRoutesMerchant Model.
     */
    public function __construct(
        Request $request,
        SystemRoutesMerchant $systemRoutesMerchant
    ) {
        parent::__construct($request);
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
