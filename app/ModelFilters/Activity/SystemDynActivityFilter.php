<?php

namespace App\ModelFilters\Activity;

use App\Models\Platform\SystemDynActivityPlatform;
use EloquentFilter\ModelFilter;

/**
 * Class SystemBankFilter
 *
 * @package App\ModelFilters\Finance
 */
class SystemDynActivityFilter extends ModelFilter
{

    /**
     * Related Models that have ModelFilters as well as the method on the ModelFilter
     * As [relationMethod => [input_key1, input_key2]].
     *
     * @var array
     */
    public $relations = [];

    /**
     * @param  integer $status Status.
     * @return SystemDynActivityFilter
     */
    public function status(int $status): SystemDynActivityFilter
    {
        return $this->where('status', $status);
    }

    /**
     * @param  string $name Name.
     * @return SystemDynActivityFilter
     */
    public function name(string $name): SystemDynActivityFilter
    {
        return $this->where('name', $name);
    }

    /**
     * 已分配给平台的活动
     * @param  string $assigned_platform_sign 平台标记.
     * @return SystemDynActivityFilter
     */
    public function assignedPlatformSign(string $assigned_platform_sign): SystemDynActivityFilter
    {
        $assignedActivities = SystemDynActivityPlatform::where('platform_sign', $assigned_platform_sign)
            ->get()
            ->pluck('activity_sign')
            ->toArray();
        return $this->whereIn('sign', $assignedActivities);
    }

    /**
     * 未分配给平台的活动
     * @param  string $unassign_platform_sign Unassign_platform_sign.
     * @return SystemDynActivityFilter
     */
    public function unassignPlatformSign(string $unassign_platform_sign): SystemDynActivityFilter
    {
        $assignedActivities = SystemDynActivityPlatform::where('platform_sign', $unassign_platform_sign)
            ->get()
            ->pluck('activity_sign')
            ->toArray();
        return $this->whereNotIn('sign', $assignedActivities);
    }
}
