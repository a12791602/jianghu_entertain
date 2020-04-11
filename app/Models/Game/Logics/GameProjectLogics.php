<?php

namespace App\Models\User\Logics;

use App\Models\Game\GameVendor;
use App\Models\User\FrontendUser;

/**
 * 帐变主逻辑
 * trait GameProjectLogics
 * @package App\Models\User\Logics
 */
trait GameProjectLogics
{
    /**
     * 储存数据 到 project 表
     *
     * @param array        $theirData  三方的数据.
     * @param FrontendUser $userObject 用户类.
     * @param GameVendor   $gameVendor 厂商类.
     * @return GameProjectLogics
     */
    public static function addData(
        array $theirData,
        FrontendUser $userObject,
        GameVendor $gameVendor
    ): GameProjectLogics {
        $request = request();
        $data    = [
                    'serial_number'       => getSerialNumber(),
                    'their_serial_number' => $theirData['serialNumber'],//string 50404120323911563198
                    'their_notifyId'      => $theirData['notifyId'], //string 161016040412032464550404120323911563198
                    'their_info_type'     => $theirData['type'],//int 16
                    'user_id'             => $userObject->id,
                    'username'            => $userObject->specificInfo->nickname ?? '',
                    'top_id'              => $userObject->top_id,
                    'parent_id'           => $userObject->parent_id,
                    'is_tester'           => $userObject->is_tester,
                    'platform_sign'       => $userObject->platform_sign,
                    'vip_level_id'        => $userObject->level_id,
                    'game_sign'           => '',
                    'game_vendor_sign'    => $gameVendor->sign,
                    'ip'                  => $request->ip(),
                    'proxy_ip'            => $request->getClientIp(),
                    'bet_money'           => $theirData['amount'],//int 10
                    'status'              => self::STATUS_BET,
                   ];
        $self    = new self();
        $self->fill($data);
        $self->save();
        return $self;
    }
}
