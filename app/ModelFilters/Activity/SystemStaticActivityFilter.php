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
        $object = $this->where('title', $title);
        return $object;
    }

    /**
     * 按平台搜索.
     *
     * @param integer $platform_id 所属平台的id.
     * @return SystemStaticActivityFilter
     */
    public function platform(int $platform_id): SystemStaticActivityFilter
    {
        $object = $this->where('platform_id', $platform_id);
        return $object;
    }

    /**
     * 按设备查找.
     *
     * @param integer $device 设备.
     * @return SystemStaticActivityFilter
     */
    public function device(int $device): SystemStaticActivityFilter
    {
        $object = $this->where('device', $device);
        return $object;
    }
}
