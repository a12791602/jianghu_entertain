<?php

namespace App\Models\Systems;

use App\Models\BaseModel;

/**
 * Class SystemFePageBanner
 * @package App\Models\Systems
 */
class SystemFePageBanner extends BaseModel
{

    /**
     * @var array $guarded
     */
    protected $guarded = ['id'];

    public const STATUS_OPEN = 1;
}
