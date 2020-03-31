<?php

namespace App\Models\Logics;

trait BaseModelLogics
{

    /**
     * 获取分页条数
     *
     * @return mixed
     */
    public static function getPageSize()
    {
        return app('request')->get('pageSize') ?? self::getDefaultPageSize();
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
