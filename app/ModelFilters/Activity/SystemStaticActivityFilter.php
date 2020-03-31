<?php

namespace App\ModelFilters\Activity;

use EloquentFilter\ModelFilter;

/**
 * Class SystemStaticActivityFilter
 * @package App\ModelFilters\Activity
 */
class SystemStaticActivityFilter extends ModelFilter
{

    /**
     * Related Models that have ModelFilters as well as the method on the ModelFilter
     * As [relationMethod => [input_key1, input_key2]].
     *
     * @var array
     */
    public $relations = [];

    /**
     * 按活动标题查找.
     *
     * @param  string $title 活动标题.
     * @return SystemStaticActivityFilter
     */
    public function title(string $title): SystemStaticActivityFilter
    {
        return $this->where('title', $title);
    }

    /**
     * 按平台搜索.
     *
     * @param integer $platform_id 所属平台的id.
     * @return SystemStaticActivityFilter
     */
    public function platform(int $platform_id): SystemStaticActivityFilter
    {
        return $this->where('platform_id', $platform_id);
    }

    /**
     * 按设备查找.
     *
     * @param integer $device 设备.
     * @return SystemStaticActivityFilter
     */
    public function device(int $device): SystemStaticActivityFilter
    {
        return $this->where('device', $device);
    }
}
