<?php

namespace App\Models\Systems;

use App\Models\BaseModel;

/**
 * Class for system domain.
 */
class SystemDomain extends BaseModel
{
    const STATUS_OPEN = 1;
    const STATUS_CLOSE = 0;

    /**
     * @var array $guarded
     */
    protected $guarded = ['id'];
}
