<?php

namespace App\Http\SingleActions\Backend\Headquarters\Setting\Admin;

use App\Http\SingleActions\MainAction;
use App\Models\Admin\BackendAdminAccessGroup;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class for group destroy action.
 */
class GroupDestroyAction extends MainAction
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
     * @param  array $inputDatas 传递的参数.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(array $inputDatas): JsonResponse
    {
        $datas = $this->model->where(
            [
             [
              'id',
              $inputDatas['id'],
             ],
             [
              'group_name',
              $inputDatas['group_name'],
             ],
            ],
        )->first();
        if ($datas === null) {
            throw new \Exception('300100');
        }
        $groupName = $datas->group_name;
        if (!$datas->delete()) {
            throw new \Exception('300104');
        }
        return msgOut(['group_name' => $groupName]);
    }
}
