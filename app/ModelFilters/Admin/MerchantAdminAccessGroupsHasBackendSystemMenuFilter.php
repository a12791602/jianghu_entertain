<?php

namespace App\ModelFilters\Admin;

use EloquentFilter\ModelFilter;

/**
 * Class for merchant admin access group filter.
 */
class MerchantAdminAccessGroupsHasBackendSystemMenuFilter extends ModelFilter
{

    /**
     * Related Models that have ModelFilters as well as the method on the ModelFilter
     * As [relationMethod => [input_key1, input_key2]].
     *
     * @var array
     */
    public $relations = [];

    /**
     * @param integer $groupId 管理员组ID.
     *
     * @return MerchantAdminAccessGroupsHasBackendSystemMenuFilter
     */
    public function groupId(int $groupId): MerchantAdminAccessGroupsHasBackendSystemMenuFilter
    {
        $eloq = $this->where('group_id', $groupId);
        return $eloq;
    }


    /**
     * 菜单搜索In
     * @param array $menuIds 菜单的ID.
     * @return MerchantAdminAccessGroupsHasBackendSystemMenuFilter
     */
    public function menuIn(array $menuIds): MerchantAdminAccessGroupsHasBackendSystemMenuFilter
    {
        $eloq = $this->whereIn('menu_id', $menuIds);
        return $eloq;
    }
}
