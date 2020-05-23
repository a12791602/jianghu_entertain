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
     * @return self
     */
    public function searchStr(string $string): self
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

    /**
     * 按发件人
     *
     * @param string $email Email.
     * @return self
     */
    public function sender(string $email): self
    {
        return $this->whereLike('email', $email);
    }
}
