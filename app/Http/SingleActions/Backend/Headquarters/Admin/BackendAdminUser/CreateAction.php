<?php

namespace App\Http\SingleActions\Backend\Headquarters\Admin\BackendAdminUser;

use App\Http\Controllers\BackendApi\BackEndApiMainController;
use App\Models\Admin\BackendAdminUser;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Arr;

/**
 * 创建后台管理员
 */
class CreateAction
{
    /**
     * Register api
     * @param BackEndApiMainController $contll     Controller.
     * @param array                    $inputDatas 接收的参数.
     * @return JsonResponse
     */
    public function execute(
        BackEndApiMainController $contll,
        array $inputDatas
    ): JsonResponse {
        $inputDatas['password'] = bcrypt($inputDatas['password']);
        $user                   = BackendAdminUser::create($inputDatas);
        $credentials            = Arr::only($inputDatas, ['email', 'password']);
        $token                  = $contll->currentAuth->attempt($credentials);
        $success                = [
            'token' => $token,
            'name'  => $user->name,
        ];
        $msgOut                 = msgOut(true, $success);
        return $msgOut;
    }
}
