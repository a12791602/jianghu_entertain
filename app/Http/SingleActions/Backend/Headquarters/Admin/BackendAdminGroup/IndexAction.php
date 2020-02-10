<?php

namespace App\Http\SingleActions\Backend\Headquarters\Admin\BackendAdminGroup;

use App\Models\Admin\BackendAdminAccessGroup;
use Illuminate\Http\JsonResponse;

/**
 * Class for index action.
 */
class IndexAction
{

    /**
     * @var BackendAdminAccessGroup
     */
    protected $model;

    /**
     * @param BackendAdminAccessGroup $backendAdminAccessGroup BackendAdminAccessGroup.
     */
    public function __construct(BackendAdminAccessGroup $backendAdminAccessGroup)
    {
        $this->model = $backendAdminAccessGroup;
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function execute(): JsonResponse
    {
        $data   = $this->model
            ->select(['id', 'group_name', 'created_at'])
            ->with('detail:group_id,menu_id')
            ->get()
            ->toArray();
        $msgOut = msgOut($data);
        return $msgOut;
    }
}
