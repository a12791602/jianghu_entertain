<?php

namespace App\Models\Traits;

trait BaseModelLogics
{

    /**
     * 获取分页条数
     *
     * @return mixed
     */
    public static function getPageSize()
    {
        $pageSize = app('request')->get('pageSize') ?? self::getDefaultPageSize();
        return $pageSize;
    }

    /**
     * 默认分页条数
     * @return integer
     */
    public static function getDefaultPageSize(): int
    {
        return 50;
    }
}
