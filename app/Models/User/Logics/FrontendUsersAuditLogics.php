<?php

namespace App\Models\User\Logics;

use App\Models\User\FrontendUser;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Str;

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
        $platformSign = self::getPlatformSign();
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
     * 获取平台标识
     * @return string
     */
    public static function getPlatformSign(): string
    {
        $platform = Request::get('current_platform_eloq');
        if ($platform) {
            return $platform->sign;
        }
        return 'JHHY';
    }

    /**
     * 生成稽核单号
     * @param  string $sign 平台标识.
     * @return string
     */
    public static function getSerialNumber(string $sign): string
    {
        return $sign . Str::orderedUuid()->getNodeHex();
    }
}
