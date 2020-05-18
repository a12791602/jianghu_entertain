<?php

namespace App\ModelFilters\Game;

use EloquentFilter\ModelFilter;

/**
 * Class GameProjectFilter
 *
 * @package App\ModelFilters\Game
 */
class GameProjectFilter extends ModelFilter
{

    /**
     * Related Models that have ModelFilters as well as the method on the ModelFilter
     * As [relationMethod => [input_key1, input_key2]].
     *
     * @var array
     */
    public $relations = ['user' => ['mobile']];

    /**
     * 平台标识
     * @param  string $sign 平台标识.
     * @return self
     */
    public function platformSign(string $sign): self
    {
        return $this->where('platform_sign', $sign);
    }

    /**
     * 用户uid
     * @param  string $guid 用户uid.
     * @return self
     */
    public function guid(string $guid): self
    {
        return $this->where('guid', $guid);
    }

    /**
     * 注单号
     * @param  string $serialNumber 注单号.
     * @return self
     */
    public function serialNumber(string $serialNumber): self
    {
        return $this->where('serial_number', $serialNumber);
    }

    /**
     * 状态
     * @param  string $status 状态.
     * @return self
     */
    public function status(string $status): self
    {
        return $this->where('status', $status);
    }

    /**
     * 游戏厂商
     * @param  string $gameVendorSign 游戏厂商.
     * @return self
     */
    public function gameVendorSign(string $gameVendorSign): self
    {
        return $this->where('game_vendor_sign', $gameVendorSign);
    }

    /**
     * 三方生成时间（下注时间）
     * @param  array $createdAt 三方生成时间（下注时间）.
     * @return self|\Illuminate\Database\Eloquent\Builder
     */
    public function theirCreateTime(array $createdAt)
    {
        if (count($createdAt) === 2) {
            $eloq = $this->whereBetween('their_create_time', $createdAt);
        } else {
            $eloq = $this;
        }
        return $eloq;
    }

    /**
     * 派彩时间.
     * @param  array $deliveryTime 派彩时间.
     * @return self|\Illuminate\Database\Eloquent\Builder
     */
    public function deliveryTime(array $deliveryTime)
    {
        if (count($deliveryTime) === 2) {
            $eloq = $this->whereBetween('delivery_time', $deliveryTime);
        } else {
            $eloq = $this;
        }
        return $eloq;
    }

    /**
     * 生成时间
     * @param  array $createdAt 生成时间.
     * @return self|\Illuminate\Database\Eloquent\Builder
     */
    public function createdAt(array $createdAt)
    {
        if (count($createdAt) === 2) {
            $eloq = $this->whereBetween('created_at', $createdAt);
        } else {
            $eloq = $this;
        }
        return $eloq;
    }
}
