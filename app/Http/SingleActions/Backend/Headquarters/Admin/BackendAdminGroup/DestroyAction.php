<?php

namespace App\Http\SingleActions\Backend\Headquarters\Admin\BackendAdminGroup;

use App\Models\Admin\BackendAdminAccessGroup;
use Illuminate\Http\JsonResponse;

/**
 * Class for destroy action.
 */
class DestroyAction
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
        $msgOut = msgOut(['group_name' => $groupName]);
        return $msgOut;
    }
}
