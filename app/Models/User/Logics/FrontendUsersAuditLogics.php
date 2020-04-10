<?php

namespace App\Models\User\Logics;

use App\Models\User\FrontendUser;

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
        $platformSign = getCurrentPlatformSign();
        if (!$platformSign) {
            throw new \Exception('101006');
        }
        $orderNumber = self::getSerialNumber($platformSign);
        $addData     = [
                        'mobile'        => $user->mobile,
                        'guid'          => $user->guid,
                        'platform_sign' => $platformSign,
                        'order_number'  => $orderNumber,
                        'type'          => $type['name'],
                        'amount'        => $amount,
                        'demand_bet'    => $demandBet,
                       ];
        $this->fill($addData);
        if (!$this->save()) {
            throw new \Exception('101007');
        }
    }

    /**
     * 生成稽核单号
     * @param  string $sign 平台标识.
     * @return string
     */
    public static function getSerialNumber(string $sign): string
    {
        return $sign . getUUidNodeHex();
    }
}
