<?php

namespace App\Http\SingleActions\Backend\Headquarters\Admin\BackendAdminUser;

use App\Models\Admin\BackendAdminUser;
use Illuminate\Http\JsonResponse;

/**
 * 修改管理员状态
 */
class SwitchAdminAction
{

    /**
     * 后台管理员
     * @var object $model BackendAdminUser
     */
    protected $model;

    /**
     * @param BackendAdminUser $backendAdminUser 总后台管理员Model.
     */
    public function __construct(BackendAdminUser $backendAdminUser)
    {
        $this->model = $backendAdminUser;
    }

    /**
     * @param array $inputDatas 传递的参数.
     * @throws \Exception Exception.
     * @return JsonResponse
     */
    public function execute(array $inputDatas): JsonResponse
    {
        $adminUser = $this->model->find($inputDatas['id']);
        if (!$adminUser) {
            throw new \Exception('301100');
        }
        $adminUser->status = $inputDatas['status'];
        if (!$adminUser->save()) {
            throw new \Exception('301104');
        }
        $msgOut = msgOut();
        return $msgOut;
    }
}
