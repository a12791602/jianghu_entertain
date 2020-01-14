<?php

namespace App\ModelFilters\Notice;

use EloquentFilter\ModelFilter;

/**
 * Class NoticeSystemFilter
 * @package App\ModelFilters\Notice
 */
class NoticeSystemFilter extends ModelFilter
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
     * @return NoticeSystemFilter
     */
    public function platform(int $platform_id): NoticeSystemFilter
    {
        $object = $this->where('platform_id', $platform_id);
        return $object;
    }

    /**
     * 按标题搜索.
     *
     * @param string $title 标题.
     * @return NoticeSystemFilter
     */
    public function title(string $title): NoticeSystemFilter
    {
        $object = $this->where('title', $title);
        return $object;
    }
}
