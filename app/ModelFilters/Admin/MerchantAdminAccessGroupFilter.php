<?php

namespace App\ModelFilters\Admin;

use App\Models\Admin\MerchantAdminAccessGroup;
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
     * @return MerchantAdminAccessGroup
     */
    public function platform(string $platformSign): MerchantAdminAccessGroup
    {
        $eloq = $this->where('platform_sign', $platformSign);
        return $eloq;
    }

    /**
     * @param string $groupName GroupName.
     *
     * @return MerchantAdminAccessGroup
     */
    public function groupName(string $groupName): MerchantAdminAccessGroup
    {
        $eloq = $this->where('group_name', $groupName);
        return $eloq;
    }

    /**
     * @param integer $super 是否超管.
     *
     * @return MerchantAdminAccessGroup
     */
    public function super(int $super): MerchantAdminAccessGroup
    {
        $eloq = $this->where('is_super', $super);
        return $eloq;
    }
}
