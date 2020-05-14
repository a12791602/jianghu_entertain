<?php

namespace App\ModelFilters\Systems;

use EloquentFilter\ModelFilter;

/**
 * 帮助设置
 */
class StaticResourceFilter extends ModelFilter
{

    /**
     * Related Models that have ModelFilters as well as the method on the ModelFilter
     * As [relationMethod => [input_key1, input_key2]].
     *
     * @var array
     */
    public $relations = [];

    /**
     * 类型
     *
     * @param  integer $type 类型.
     * @return self
     */
    public function type(int $type): self
    {
        return $this->where('type', $type);
    }

    /**
     * 类型
     *
     * @param  integer $static_type 类型.
     * @return self
     */
    public function staticType(int $static_type): self
    {
        return $this->where('static_type', $static_type);
    }

    /**
     * 状态
     *
     * @param  integer $status 类型.
     * @return self
     */
    public function status(int $status): self
    {
        return $this->where('status', $status);
    }

    /**
     * 表名
     *
     * @param  string $table_name 表名.
     * @return self
     */
    public function tableName(string $table_name): self
    {
        return $this->where('table_name', $table_name);
    }

    /**
     * 备注
     *
     * @param  string $title 备注.
     * @return self
     */
    public function title(string $title): self
    {
        return $this->where('title', $title);
    }
}
