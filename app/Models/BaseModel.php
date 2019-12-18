<?php

namespace App\Models;

use EloquentFilter\Filterable;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    use Cachable,Filterable;
    private const DEFAULT_PAGESIZE = 50;

    /**
     * 获取分页条数
     *
     * @return int|mixed
     */
    public static function getPageSize()
    {
        return app('request')->get('pageSize')??self::DEFAULT_PAGESIZE;
    }
}
