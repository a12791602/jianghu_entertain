<?php

namespace App\Http\SingleActions\Backend\Headquarters\DeveloperUsage\Backend\Route;

use App\Models\DeveloperUsage\Backend\SystemRoutesBackend;
use Illuminate\Http\JsonResponse;

/**
 * 路由-列表
 */
class IndexAction
{

    /**
     * @var SystemRoutesBackend
     */
    protected $model;

    /**
     * @param SystemRoutesBackend $systemRoutesBackend Model.
     */
    public function __construct(SystemRoutesBackend $systemRoutesBackend)
    {
        $this->model = $systemRoutesBackend;
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
