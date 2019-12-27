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
     * @return $this
     */
    public function platformSign(string $sign)
    {
        $eloq = $this->where('platform_sign', $sign);
        return $eloq;
    }

    /**
     * 游戏类型ID查询
     *
     * @param  string $typeId 游戏类型ID.
     * @return $this
     */
    public function gameTypeId(string $typeId)
    {
        $eloq = $this->where('game_type_id', $typeId);
        return $eloq;
    }

    /**
     * 厂商ID查询
     *
     * @param  string $vendorId 厂商ID.
     * @return $this
     */
    public function gameVendorId(string $vendorId)
    {
        $eloq = $this->where('game_vendor_id', $vendorId);
        return $eloq;
    }

    /**
     * 排除ID
     *
     * @param  integer $configId ID.
     * @return $this
     */
    public function notInId(int $configId)
    {
        $eloq = $this->where('id', '!=', $configId);
        return $eloq;
    }
}
