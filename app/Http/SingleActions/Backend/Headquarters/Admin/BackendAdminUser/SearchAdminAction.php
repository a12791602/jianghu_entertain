<?php

namespace App\Http\SingleActions\Backend\Headquarters\Admin\BackendAdminUser;

use App\Http\SingleActions\MainAction;
use App\ModelFilters\Admin\BackendAdminUserFilter;
use App\Models\Admin\BackendAdminUser;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class for search admin action.
 */
class SearchAdminAction extends MainAction
{

    /**
     * @var object $model BackendAdminUser.
     */
    protected $model;

    /**
     * @param Request          $request          Request.
     * @param BackendAdminUser $backendAdminUser BackendAdminUser.
     */
    public function __construct(
        Request $request,
        BackendAdminUser $backendAdminUser
    ) {
        parent::__construct($request);
        $this->model = $backendAdminUser;
    }

    /**
     * @param array $inputDatas 接收的参数.
     * @return JsonResponse
     */
    public function execute(array $inputDatas): JsonResponse
    {
        $data   = $this->model
            ->filter($inputDatas, BackendAdminUserFilter::class)
            ->get(['id', 'name', 'email', 'status', 'group_id', 'created_at'])
            ->toArray();
        $msgOut = msgOut($data);
        return $msgOut;
    }
}
