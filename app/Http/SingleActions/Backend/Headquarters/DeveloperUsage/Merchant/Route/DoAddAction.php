<?php

namespace App\Http\SingleActions\Backend\Headquarters\DeveloperUsage\Merchant\Route;

use App\Http\SingleActions\MainAction;
use App\Models\DeveloperUsage\Merchant\SystemRoutesMerchant;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * 路由-添加
 */
class DoAddAction extends MainAction
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
        $this->model->fill($inputDatas);
        if (!$this->model->save()) {
            throw new \Exception('302300');
        }
        $msgOut = msgOut(['title' => $this->model->title]);
        return $msgOut;
    }
}
