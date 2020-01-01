<?php

namespace App\Models\User\Logics;

use App\Lib\Locker\AccountLocker;
use App\Lib\Logic\AccountChange;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

trait UserAccountLogics
{

    /**
     * @param  array  $params 参数.
     * @param  string $type   帐变类型.
     * @return mixed
     */
    public function operateAccount(array $params, string $type)
    {
        $accountLocker = new AccountLocker($this->frontendUser->id);
        if (!$accountLocker->getLock()) {
            $message = '对不起, 获取账户锁失败!';
            return $message;
        }
        try {
            // 帐变
            $accountChange = new AccountChange($this);
            DB::beginTransaction();
            $resource = $accountChange->doChange($type, $params);
            // $accountChange->triggerSave();
            $accountLocker->release();
            if ($resource !== true) {
                DB::rollback();
                $message = '对不起, ' . $resource;
                return $message;
            }
            DB::commit();
            return true;
        } catch (\Throwable $e) {
            $accountLocker->release();
            Log::info('投注-异常:' . $e->getMessage() . '|' . $e->getFile() . '|' . $e->getLine());
            $message = '对不起, ' . $e->getMessage() . '|' . $e->getFile() . '|' . $e->getLine();
            return $message;
        }
    }
}
