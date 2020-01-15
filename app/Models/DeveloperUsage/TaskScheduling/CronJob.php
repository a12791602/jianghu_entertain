<?php

namespace App\Models\DeveloperUsage\TaskScheduling;

use App\Models\BaseModel;

/**
 * 定时任务
 */
class CronJob extends BaseModel
{

    public const STATUS_OPEN  = 1;
    public const STATUS_CLOSE = 0;

    /**
     * @var array
     */
    protected $guarded = ['id'];
}
