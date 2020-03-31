<?php

namespace App\ModelFilters\Admin;

use EloquentFilter\ModelFilter;

/**
 * Class for merchant admin user filter.
 */
class BackendAdminUserFilter extends ModelFilter
{

    /**
     * Related Models that have ModelFilters as well as the method on the ModelFilter
     * As [relationMethod => [input_key1, input_key2]].
     *
     * @var array
     */
    public $relations = [];

    /**
     * @param string $string 搜索的字符串.
     *
     * @return $this
     */
    public function searchStr(string $string): BackendAdminUserFilter
    {
        return $this->whereLike('name', $string)->orWhere('email', 'like', '%' . $string . '%');
    }

    /**
     * 名称查询
     *
     * @param  string $name 名称.
     * @return $this
     */
    public function name(string $name): BackendAdminUserFilter
    {
        return $this->where('name', $name);
    }
}
