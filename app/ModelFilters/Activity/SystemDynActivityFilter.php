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
        $object = $this->where('status', $status);
        return $object;
    }

    /**
     * @param  string $name Name.
     * @return SystemDynActivityFilter
     */
    public function name(string $name): SystemDynActivityFilter
    {
        $object = $this->where('name', $name);
        return $object;
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
        $object             = $this->whereIn('sign', $assignedActivities);
        return $object;
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
        $object             = $this->whereNotIn('sign', $assignedActivities);
        return $object;
    }
}
