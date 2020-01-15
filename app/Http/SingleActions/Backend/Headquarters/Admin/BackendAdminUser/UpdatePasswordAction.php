<?php

namespace App\Http\SingleActions\Backend\Headquarters\Admin\BackendAdminUser;

use App\Models\Admin\BackendAdminUser;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

/**
 * 修改管理员密码
 */
class UpdatePasswordAction
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
            $msgOut = msgOut(true, ['name' => $inputDatas['name']]);
            return $msgOut;
        }
        throw new \Exception('301100');
    }
}
