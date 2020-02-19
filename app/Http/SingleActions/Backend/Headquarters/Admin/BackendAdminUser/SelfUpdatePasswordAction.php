<?php

namespace App\Http\SingleActions\Backend\Headquarters\Admin\BackendAdminUser;

use App\Http\SingleActions\MainAction;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

/**
 * 管理员自己修改密码
 */
class SelfUpdatePasswordAction extends MainAction
{

    /**
     * @param array $inputDatas 传递的参数.
     * @throws \Exception Exception.
     * @return JsonResponse
     */
    public function execute(array $inputDatas): JsonResponse
    {
        if (!Hash::check($inputDatas['old_password'], $this->user->password)) {
            throw new \Exception('301102');
        }
        $token                      = $this->user->refresh();
        $this->user->password       = Hash::make($inputDatas['password']);
        $this->user->remember_token = $token;
        if (!$this->user->save()) {
            throw new \Exception('301103');
        }
        $expireInMinute = $this->auth->factory()->getTTL();
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
