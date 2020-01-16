<?php

namespace App\Http\SingleActions\Backend\Headquarters\Admin\BackendAdminUser;

use App\Http\Controllers\BackendApi\Headquarters\Admin\BackendAdminUserController;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

/**
 * 管理员自己修改密码
 */
class SelfUpdatePasswordAction
{
    /**
     * @param BackendAdminUserController $contll     Controller.
     * @param array                      $inputDatas 传递的参数.
     * @throws \Exception Exception.
     * @return JsonResponse
     */
    public function execute(BackendAdminUserController $contll, array $inputDatas): JsonResponse
    {
        if (!Hash::check($inputDatas['old_password'], $contll->currentAdmin->password)) {
            throw new \Exception('301102');
        }
        $token                                = $contll->currentAuth->refresh();
        $contll->currentAdmin->password       = Hash::make($inputDatas['password']);
        $contll->currentAdmin->remember_token = $token;
        if (!$contll->currentAdmin->save()) {
            throw new \Exception('301103');
        }
        $expireInMinute = $contll->currentAuth->factory()->getTTL();
        $expireAt       = Carbon::now()->addMinutes($expireInMinute)->format('Y-m-d H:i:s');
        $data           = [
                           'access_token' => $token,
                           'token_type'   => 'Bearer',
                           'expires_at'   => $expireAt,
                          ];
        $msgOut         = msgOut($data);
        return $msgOut;
    }
}
