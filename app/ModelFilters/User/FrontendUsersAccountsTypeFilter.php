<?php

namespace App\ModelFilters\User;

use EloquentFilter\ModelFilter;

/**
 * 账变类型
 */
class FrontendUsersAccountsTypeFilter extends ModelFilter
{

    /**
     * Related Models that have ModelFilters as well as the method on the ModelFilter
     * As [relationMethod => [input_key1, input_key2]].
     *
     * @var array
     */
    public $relations = [];

    /**
     * 前台是否显示
     *
     * @param  integer $display 前台是否显示.
     * @return self
     */
    public function frontendDisplay(int $display): self
    {
        return $this->where('frontend_display', $display);
    }
}
