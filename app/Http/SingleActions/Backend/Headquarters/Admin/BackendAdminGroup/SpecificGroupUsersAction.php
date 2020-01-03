<?php

namespace App\Http\SingleActions\Backend\Headquarters\Admin\BackendAdminGroup;

use App\Models\Admin\BackendAdminUser;
use Illuminate\Http\JsonResponse;

/**
 * Class for specific group users action.
 */
class SpecificGroupUsersAction
{

    /**
     * @var BackendAdminUser
     */
    protected $model;

    /**
     * @param BackendAdminUser $backendAdminUser BackendAdminUser.
     */
    public function __construct(BackendAdminUser $backendAdminUser)
    {
        $this->model = $backendAdminUser;
    }

    /**
     * @param  array $inputDatas 传递的参数.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(array $inputDatas): JsonResponse
    {
        $data   = $this->model->where('group_id', $inputDatas['id'])->paginate($this->model::getPageSize());
        $msgOut = msgOut(true, $data);
        return $msgOut;
    }
}
