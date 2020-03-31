<?php

namespace App\Http\SingleActions\Backend\Headquarters\Setting\Admin;

use App\Http\SingleActions\MainAction;
use App\Models\Admin\BackendAdminAccessGroup;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class for gourp list action.
 */
class GroupListAction extends MainAction
{

    /**
     * @var BackendAdminAccessGroup
     */
    protected $model;

    /**
     * @param Request                 $request                 Request.
     * @param BackendAdminAccessGroup $backendAdminAccessGroup BackendAdminAccessGroup.
     */
    public function __construct(
        Request $request,
        BackendAdminAccessGroup $backendAdminAccessGroup
    ) {
        parent::__construct($request);
        $this->model = $backendAdminAccessGroup;
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function execute(): JsonResponse
    {
        $data = $this->model
            ->with('detail:group_id,menu_id')
            ->get(['id', 'group_name', 'created_at'])
            ->toArray();
        return msgOut($data);
    }
}
