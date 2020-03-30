<?php

namespace App\ModelFilters\User;

use EloquentFilter\ModelFilter;

/**
 * 洗码设置
 */
class UsersCommissionConfigFilter extends ModelFilter
{

    /**
     * Related Models that have ModelFilters as well as the method on the ModelFilter
     * As [relationMethod => [input_key1, input_key2]].
     *
     * @var array
     */
    public $relations = [];

    /**
     * 平台标识查询
     *
     * @param  string $sign 平台标识.
     * @return UsersCommissionConfigFilter
     */
    public function platformSign(string $sign): UsersCommissionConfigFilter
    {
        $eloq = $this->where('platform_sign', $sign);
        return $eloq;
    }

    /**
     * 游戏类型ID查询
     *
     * @param  string $typeId 游戏类型ID.
     * @return UsersCommissionConfigFilter
     */
    public function gameType(string $typeId): UsersCommissionConfigFilter
    {
        $eloq = $this->where('game_type_id', $typeId);
        return $eloq;
    }

    /**
     * 厂商ID查询
     *
     * @param  string $vendorId 厂商ID.
     * @return UsersCommissionConfigFilter
     */
    public function gameVendor(string $vendorId): UsersCommissionConfigFilter
    {
        $eloq = $this->where('game_vendor_id', $vendorId);
        return $eloq;
    }

    /**
     * 排除ID
     *
     * @param  integer $configId ID.
     * @return UsersCommissionConfigFilter
     */
    public function notInId(int $configId): UsersCommissionConfigFilter
    {
        $eloq = $this->where('id', '!=', $configId);
        return $eloq;
    }
}
