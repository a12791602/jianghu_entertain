<?php

namespace App\Http\SingleActions\Backend\Headquarters\Setting\Admin;

use App\Http\SingleActions\MainAction;
use App\Models\Admin\BackendAdminUser;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * 修改管理员状态
 */
class SwitchAdminAction extends MainAction
{

    /**
     * 后台管理员
     * @var object $model BackendAdminUser
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
