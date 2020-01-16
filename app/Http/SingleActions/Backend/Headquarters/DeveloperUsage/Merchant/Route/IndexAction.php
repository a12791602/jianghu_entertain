<?php

namespace App\Http\SingleActions\Backend\Headquarters\DeveloperUsage\Merchant\Route;

use App\Models\DeveloperUsage\Merchant\SystemRoutesMerchant;
use Illuminate\Http\JsonResponse;

/**
 * 路由-列表
 */
class IndexAction
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
     * @return JsonResponse
     */
    public function execute(): JsonResponse
    {
        $data   = $this->model
            ->select(['id', 'route_name', 'menu_group_id', 'title', 'description', 'is_open'])
            ->get();
        $msgOut = msgOut($data);
        return $msgOut;
    }
}
