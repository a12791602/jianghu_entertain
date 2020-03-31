<?php

namespace App\Http\SingleActions\Frontend\Test;

use App\Http\SingleActions\MainAction;
use Illuminate\Http\Request;

/**
 * Class AccountChangeAction
 */
class AccountChangeAction extends MainAction
{
  
    /**
     * @param Request $request Request.
     * @return mixed
     * @throws \Exception Exception.
     */
    public function execute(Request $request)
    {
        $inputDatas = $request->all();
        $user       = $this->user;
        if (!$user) {
            return '用户不存在';
        }
        $account = $user->account;
        if (!$account) {
            return '用户金额表不存在';
        }
        if (!$inputDatas['params']) {
            $inputDatas['params'] = [];
        }
        $data = $account->operateAccount($inputDatas, $inputDatas['type'], $inputDatas['params']);
        return msgOut($data);
    }
}
