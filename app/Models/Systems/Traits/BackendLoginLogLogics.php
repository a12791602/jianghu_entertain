<?php

namespace App\Models\Systems\Traits;

use Illuminate\Http\Request;

trait BackendLoginLogLogics
{
    /**
     * 插入管理员登录记录
     *
     * @param  object  $user    管理员Eloq.
     * @param  Request $request 接收的参数.
     * @param  integer $type    总后台1  代理后台2.
     * @return void
     */
    public function insertData(object $user, Request $request, int $type): void
    {
        $addData = [
                    'name'  => $user->name,
                    'email' => $user->email,
                    'ip'    => $request->ip(),
                    'ips'   => implode(',', $request->ips()),
                    'type'  => $type,
                   ];
        $this->fill($addData);
        $this->save();
    }
}
