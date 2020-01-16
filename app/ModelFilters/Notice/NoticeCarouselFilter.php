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
     * @return NoticeCarouselFilter
     */
    public function platform(int $platform_id): NoticeCarouselFilter
    {
        $object = $this->where('platform_id', $platform_id);
        return $object;
    }

    /**
     * 按标题搜索.
     *
     * @param string $title 标题.
     * @return NoticeCarouselFilter
     */
    public function title(string $title): NoticeCarouselFilter
    {
        $object = $this->where('title', $title);
        return $object;
    }

    /**
     * 按设备查找.
     *
     * @param integer $device 设备.
     * @return NoticeCarouselFilter
     */
    public function device(int $device): NoticeCarouselFilter
    {
        $object = $this->where('device', $device);
        return $object;
    }
}
