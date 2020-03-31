<?php

namespace App\Http\SingleActions\Backend\Headquarters\Setting\Admin;

use App\Http\SingleActions\MainAction;
use App\Models\Admin\BackendAdminUser;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

/**
 * 修改管理员密码
 */
class UpdatePasswordAction extends MainAction
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
        $adminEloq = $this->model::where(
            [
             [
              'id',
              '=',
              $inputDatas['id'],
             ],
             [
              'name',
              '=',
              $inputDatas['name'],
             ],
            ],
        )->first();
        if ($adminEloq !== null) {
            $adminEloq->password = Hash::make($inputDatas['password']);
            $adminEloq->save();
            return msgOut(['name' => $inputDatas['name']]);
        }
        throw new \Exception('301100');
    }
}
