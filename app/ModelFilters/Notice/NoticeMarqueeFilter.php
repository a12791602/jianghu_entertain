<?php

namespace App\ModelFilters\Notice;

use EloquentFilter\ModelFilter;

/**
 * Class NoticeMarqueeFilter
 * @package App\ModelFilters\Notice
 */
class NoticeMarqueeFilter extends ModelFilter
{

    /**
     * Related Models that have ModelFilters as well as the method on the ModelFilter
     * As [relationMethod => [input_key1, input_key2]].
     *
     * @var array
     */
    public $relations = [];

    /**
     * 按公告标题搜索.
     *
     * @param string $title 标题.
     * @return self
     */
    public function title(string $title): self
    {
        return $this->whereLike('title', $title);
    }

    /**
     * 按平台搜索.
     *
     * @param integer $platform_id 平台id.
     * @return self
     */
    public function platform(int $platform_id): self
    {
        return $this->where('platform_id', $platform_id);
    }

    /**
     * 设备查找.
     *
     * @param integer $device 设备id.
     * @return self
     */
    public function device(int $device): self
    {
        return $this->whereJsonContains('device', $device);
    }
}
