<?php

namespace App\Models\Systems;

use App\Models\BaseModel;
use App\Models\Systems\Logics\StaticResourceLogics;

/**
 * 静态资源
 */
class StaticResource extends BaseModel
{
    use StaticResourceLogics;

    public const STATIC_TYPE_PIC = 1;//图片类型

    public const STATIC_TYPE_JSON = 2;//JSON 类型

    public const TYPE_DATA = 1;//以数据传输方式 转变 json

    public const TYPE_WHOLE_TABLE = 2;//以表 转变 json

    /**
     * @var array $guarded
     */
    protected $guarded = ['id'];
}
