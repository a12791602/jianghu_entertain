<?php

namespace App\Http\SingleActions\Backend\Headquarters\DeveloperUsage\Merchant\Route;

use App\Http\SingleActions\MainAction;
use App\Models\DeveloperUsage\Merchant\SystemRoutesMerchant;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * 路由-列表
 */
class IndexAction extends MainAction
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
     * @return JsonResponse
     */
    public function execute(): JsonResponse
    {
        $data   = $this->model->get(['id', 'route_name', 'menu_group_id', 'title', 'description', 'is_open']);
        $msgOut = msgOut($data);
        return $msgOut;
    }
}
