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
        return $this->where('platform_sign', $sign);
    }

    /**
     * 游戏类型查询
     *
     * @param  string $sign 游戏类型标识.
     * @return UsersCommissionConfigFilter
     */
    public function gameType(string $sign): UsersCommissionConfigFilter
    {
        return $this->where('game_type_sign', $sign);
    }

    /**
     * 厂商查询
     *
     * @param  string $sign 厂商标识.
     * @return UsersCommissionConfigFilter
     */
    public function gameVendor(string $sign): UsersCommissionConfigFilter
    {
        return $this->where('game_vendor_sign', $sign);
    }

    /**
     * 排除ID
     *
     * @param  integer $configId ID.
     * @return UsersCommissionConfigFilter
     */
    public function notInId(int $configId): UsersCommissionConfigFilter
    {
        return $this->where('id', '!=', $configId);
    }

    /**
     * 打码量查询
     *
     * @param  float $betSum 打码量.
     * @return UsersCommissionConfigFilter
     */
    public function betEgt(float $betSum): UsersCommissionConfigFilter
    {
        return $this->where('bet', '<=', $betSum);
    }
}
