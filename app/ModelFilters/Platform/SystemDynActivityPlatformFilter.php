<?php

namespace App\ModelFilters\Platform;

use EloquentFilter\ModelFilter;

/**
 * Class SystemDynActivityPlatformFilter
 * @package App\ModelFilters\Platform
 */
class SystemDynActivityPlatformFilter extends ModelFilter
{

    /**
     * Related Models that have ModelFilters as well as the method on the ModelFilter
     * As [relationMethod => [input_key1, input_key2]].
     *
     * @var array
     */
    public $relations = ['activity' => ['name']]; //SystemDynActivityFilter

    /**
     * 根据平台标记查询
     * @param string $platform_sign PlatformSign.
     * @return SystemDynActivityPlatformFilter
     */
    public function platformSign(string $platform_sign): SystemDynActivityPlatformFilter
    {
        return $this->where('platform_sign', $platform_sign);
    }
}
