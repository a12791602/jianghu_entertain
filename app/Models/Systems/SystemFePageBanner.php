<?php

namespace App\Models\Systems;

use App\Models\BaseModel;

/**
 * Class SystemFePageBanner
 * @package App\Models\Systems
 */
class SystemFePageBanner extends BaseModel
{

    public const STATUS_OPEN = 1;

    /**
     * @var array $guarded
     */
    protected $guarded = ['id'];
}
