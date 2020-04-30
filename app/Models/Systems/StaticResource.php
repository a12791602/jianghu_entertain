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

    /**
     * @var array $guarded
     */
    protected $guarded = ['id'];
}
