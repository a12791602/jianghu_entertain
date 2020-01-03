<?php

namespace App\Http\Controllers\FrontendApi\Test;

use App\Http\Controllers\FrontendApi\FrontendApiMainController;
use Illuminate\Http\Request;

/**
 * Class TestController
 * @package App\Http\Controllers\FrontendApi\Test
 */
class TestController extends FrontendApiMainController
{

    /**
     * 测试帐变接口
     * @param  Request $request Request.
     * @return mixed
     */
    public function accountChange(Request $request)
    {
        $inputDatas = $request->all();
        $user       = $this->frontendUser;
        if (!$user) {
            return;
        }
        $account = $user->account;
        if (!$account) {
            return;
        }
        $data   = $account->operateAccount($inputDatas, $inputDatas['params'], $inputDatas['type']);
        $msgOut = msgOut(true, $data);
        return $msgOut;
    }
}
