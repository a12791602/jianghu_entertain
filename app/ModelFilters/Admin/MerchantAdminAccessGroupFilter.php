<?php

namespace App\ModelFilters\Admin;

use EloquentFilter\ModelFilter;

/**
 * Class for merchant admin access group filter.
 */
class MerchantAdminAccessGroupFilter extends ModelFilter
{

    /**
     * Related Models that have ModelFilters as well as the method on the ModelFilter
     * As [relationMethod => [input_key1, input_key2]].
     *
     * @var array
     */
    public $relations = [];

    /**
     * @param string $platformSign PlatformSign.
     *
     * @return MerchantAdminAccessGroupFilter
     */
    public function platform(string $platformSign): MerchantAdminAccessGroupFilter
    {
        return $this->where('platform_sign', $platformSign);
    }

    /**
     * @param string $groupName GroupName.
     *
     * @return MerchantAdminAccessGroupFilter
     */
    public function groupName(string $groupName): MerchantAdminAccessGroupFilter
    {
        return $this->where('group_name', $groupName);
    }

    /**
     * @param integer $super 是否超管.
     *
     * @return MerchantAdminAccessGroupFilter
     */
    public function super(int $super): MerchantAdminAccessGroupFilter
    {
        return $this->where('is_super', $super);
    }
}
