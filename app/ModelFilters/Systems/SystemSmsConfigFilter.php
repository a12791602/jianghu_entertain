<?php

namespace App\ModelFilters\Systems;

use EloquentFilter\ModelFilter;

/**
 *  Class SystemSmsConfigFilter
 *
 * @package App\ModelFilters\Game
 */
class SystemSmsConfigFilter extends ModelFilter
{

    /**
     * Related Models that have ModelFilters as well as the method on the ModelFilter
     * As [relationMethod => [input_key1, input_key2]].
     *
     * @var array
     */
    public $relations = [
                         'admin' => ['name'],
                        ];

    /**
     * 修改时间查询
     *
     * @param  array $updatedAt 修改时间.
     * @return SystemSmsConfigFilter
     */
    public function updatedAt(array $updatedAt): SystemSmsConfigFilter
    {
        if (!$this instanceof SystemSmsConfigFilter) {
            return $this->whereBetween('updated_at', $updatedAt);
        }
        return $this;
    }

    /**
     * 状态查询
     *
     * @param integer $status 状态.
     * @return $this
     */
    public function status(int $status): SystemSmsConfigFilter
    {
        return $this->where('status', $status);
    }
}
