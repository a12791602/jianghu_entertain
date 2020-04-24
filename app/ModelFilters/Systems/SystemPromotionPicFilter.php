<?php

namespace App\ModelFilters\Systems;

use EloquentFilter\ModelFilter;

/**
 * 推广图片
 */
class SystemPromotionPicFilter extends ModelFilter
{

    /**
     * Related Models that have ModelFilters as well as the method on the ModelFilter
     * As [relationMethod => [input_key1, input_key2]].
     *
     * @var array
     */
    public $relations = [];

    /**
     * 客户端类型
     *
     * @param  integer $device 客户端类型.
     * @return SystemPromotionPicFilter
     */
    public function device(int $device): SystemPromotionPicFilter
    {
        return $this->where('device', $device);
    }

    /**
     * 状态
     *
     * @param  integer $status 状态.
     * @return SystemPromotionPicFilter
     */
    public function status(int $status): SystemPromotionPicFilter
    {
        return $this->where('status', $status);
    }

    /**
     * 平台ID
     *
     * @param  string $platformId 平台ID.
     * @return SystemPromotionPicFilter
     */
    public function platform(string $platformId): SystemPromotionPicFilter
    {
        return $this->where('platform_id', $platformId);
    }
    
    /**
     * ID
     *
     * @param  string $dataId ID.
     * @return SystemPromotionPicFilter
     */
    public function data(string $dataId): SystemPromotionPicFilter
    {
        return $this->where('id', $dataId);
    }
}
