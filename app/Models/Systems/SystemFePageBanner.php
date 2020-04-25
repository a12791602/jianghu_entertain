<?php

namespace App\Models\Systems;

use App\Models\FilterModel;

/**
 * Class SystemFePageBanner
 * @package App\Models\Systems
 */
class SystemFePageBanner extends FilterModel
{

    public const STATUS_OPEN = 1;

    /**
     * @var array $guarded
     */
    protected $guarded = ['id'];
}
