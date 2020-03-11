<?php

namespace App\Models\User\Logics;

use App\Lib\Locker\AccountLocker;
use Illuminate\Support\Facades\DB;

trait UserAccountLogics
{

    /**
     * @param  array  $inputDatas 接收的数据.
     * @param  string $type       帐变类型.
     * @param  array  $params     扩展数据.
     * @throws \Exception Exception.
     * @return mixed
     */
    public function operateAccount(array $inputDatas, string $type, array $params = [])
    {
        $accountLocker = new AccountLocker($this->frontendUser->id);
        if (!$accountLocker->getLock()) {
            throw new \Exception('100200');
        }
        // 帐变
        DB::beginTransaction();
        $resource = $this->doChange($inputDatas, $type, $params);
        $accountLocker->release();
        if ($resource !== true) {
            DB::rollback();
            throw new \Exception('100204');
        }
        DB::commit();
        return true;
    }
}
