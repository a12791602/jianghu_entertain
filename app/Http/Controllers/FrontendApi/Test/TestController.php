<?php

namespace App\Http\Controllers\FrontendApi\Test;

use App\Http\SingleActions\MainAction;
use Illuminate\Http\Request;

/**
 * Class TestController
 * @package App\Http\Controllers\FrontendApi\Test
 */
class TestController extends MainAction
{

    /**
     * 测试帐变接口
     * @param Request $request Request.
     * @return mixed
     * @throws \Exception Exception.
     */
    public function accountChange(Request $request)
    {
        $inputDatas = $request->all();
        $user       = $this->user;
        if (!$user) {
            return;
        }
        $account = $user->account;
        if (!$account) {
            return;
        }
        $inputDatas['params'] = json_decode($inputDatas['params'], true);
        if (!$inputDatas['params']) {
            $inputDatas['params'] = [];
        }
        $data   = $account->operateAccount($inputDatas, $inputDatas['type'], $inputDatas['params']);
        $msgOut = msgOut($data);
        return $msgOut;
    }
}
