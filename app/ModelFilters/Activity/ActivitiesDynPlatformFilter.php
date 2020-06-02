<?php

namespace App\ModelFilters\Activity;

use EloquentFilter\ModelFilter;

/**
 * Class SystemStaticActivityFilter
 * @package App\ModelFilters\Activity
 */
class ActivitiesDynPlatformFilter extends ModelFilter
{

    /**
     * Related Models that have ModelFilters as well as the method on the ModelFilter
     * As [relationMethod => [input_key1, input_key2]].
     *
     * @var array
     */
    public $relations = [];

    /**
     * 动态活动Id.
     *
     * @param  string $activity_dyn_id 动态活动Id.
     * @return self
     */
    public function activityDyn(string $activity_dyn_id): self
    {
        return $this->where('activity_dyn_id', $activity_dyn_id);
    }

    /**
     * 平台id.
     *
     * @param string $platform_id 平台id.
     * @return self
     */
    public function platform(string $platform_id): self
    {
        return $this->where('platform_id', $platform_id);
    }

    /**
     * 状态.
     *
     * @param string $status 状态.
     * @return self
     */
    public function status(string $status): self
    {
        return $this->where('status', $status);
    }
}
