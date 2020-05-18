<?php

namespace App\ModelFilters\Notice;

use EloquentFilter\ModelFilter;

/**
 * Class NoticeCarouselFilter
 * @package App\ModelFilters\Notice
 */
class NoticeCarouselFilter extends ModelFilter
{

    /**
     * Related Models that have ModelFilters as well as the method on the ModelFilter
     * As [relationMethod => [input_key1, input_key2]].
     *
     * @var mixed[]
     */
    public $relations = [];

    /**
     * 按平台搜索.
     *
     * @param integer $platform_id 所属平台的id.
     * @return self
     */
    public function platform(int $platform_id): self
    {
        return $this->where('platform_id', $platform_id);
    }

    /**
     * 按标题搜索.
     *
     * @param string $title 标题.
     * @return self
     */
    public function title(string $title): self
    {
        return $this->where('title', $title);
    }

    /**
     * 按设备查找.
     *
     * @param integer $device 设备.
     * @return self
     */
    public function device(int $device): self
    {
        return $this->where('device', $device);
    }

    /**
     * 跳转方式查找.
     *
     * @param integer $type 跳转方式.
     * @return self
     */
    public function type(int $type): self
    {
        return $this->where('type', $type);
    }
}
