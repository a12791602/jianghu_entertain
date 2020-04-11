<?php

namespace App\Models\User\Logics;

use App\Models\User\FrontendUser;
use App\Models\User\FrontendUsersAccount;
use Illuminate\Support\Facades\DB;

trait FrontendUsersAuditLogics
{
    /**
     * 生成稽核
     * @param  FrontendUser $user      用户Eloq.
     * @param  array        $type      账变类型Arr.
     * @param  float        $amount    金额.
     * @param  float        $demandBet 需求打码量.
     * @throws \Exception Exception.
     * @return void
     */
    public function createAudit(
        FrontendUser $user,
        array $type,
        float $amount,
        float $demandBet
    ): void {
        $addData = [
                    'mobile'        => $user->mobile,
                    'guid'          => $user->guid,
                    'platform_sign' => getCurrentPlatformSign(),
                    'order_number'  => getSerialNumber(),
                    'type'          => $type['name'],
                    'amount'        => $amount,
                    'demand_bet'    => $demandBet,
                   ];
        $this->fill($addData);
        if (!$this->save()) {
            DB::rollback();
            throw new \Exception('101007');
        }
        //修改账户稽核状态为未完成
        $user = $this->user;
        if ($user === null) {
            DB::rollback();
            throw new \Exception('101008');
        }
        $account = $user->account;
        if ($account === null) {
            DB::rollback();
            throw new \Exception('101009');
        }
        $account->tax_status = FrontendUsersAccount::TAX_STATUS_YES;
        if ($account->save() === false) {
            DB::rollback();
            throw new \Exception('101010');
        }
    }
}
