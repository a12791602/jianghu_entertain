<?php

namespace App\ModelFilters\Admin;

use EloquentFilter\ModelFilter;

/**
 * Class for merchant admin user filter.
 */
class BackendAdminAccessGroupFilter extends ModelFilter
{

    /**
     * Related Models that have ModelFilters as well as the method on the ModelFilter
     * As [relationMethod => [input_key1, input_key2]].
     *
     * @var array
     */
    public $relations = [];

    /**
     * ID查找
     * @param integer $groupId 管理组ID.
     * @return BackendAdminAccessGroupFilter
     */
    public function id(int $groupId): BackendAdminAccessGroupFilter
    {
        $eloq = $this->where('id', $groupId);
        return $eloq;
    }

    /**
     * 名称查找
     * @param string $groupName 管理组名称.
     * @return BackendAdminAccessGroupFilter
     */
    public function groupName(string $groupName): BackendAdminAccessGroupFilter
    {
        $eloq = $this->where('group_name', $groupName);
        return $eloq;
    }
}
