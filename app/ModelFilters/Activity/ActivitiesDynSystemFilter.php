<?php

namespace App\ModelFilters\Activity;

use EloquentFilter\ModelFilter;

/**
 * Class SystemStaticActivityFilter
 * @package App\ModelFilters\Activity
 */
class ActivitiesDynSystemFilter extends ModelFilter
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
     * @return self
     */
    public function title(string $title): self
    {
        return $this->where('title', $title);
    }

    /**
     * 活动标记.
     *
     * @param string $sign 活动标记.
     * @return self
     */
    public function sign(string $sign): self
    {
        return $this->where('sign', $sign);
    }
}
