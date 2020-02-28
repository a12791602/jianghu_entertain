<?php

namespace App\Http\SingleActions\Backend\Headquarters\DeveloperUsage\Backend\Route;

use App\Http\SingleActions\MainAction;
use App\Models\DeveloperUsage\Backend\SystemRoutesBackend;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * 路由-列表
 */
class IndexAction extends MainAction
{

    /**
     * @var SystemRoutesBackend
     */
    protected $model;

    /**
     * @param Request             $request             Request.
     * @param SystemRoutesBackend $systemRoutesBackend Model.
     */
    public function __construct(
        Request $request,
        SystemRoutesBackend $systemRoutesBackend
    ) {
        parent::__construct($request);
        $this->model = $systemRoutesBackend;
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
