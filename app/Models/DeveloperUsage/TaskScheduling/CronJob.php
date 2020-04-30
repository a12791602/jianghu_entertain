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

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['param' => 'array'];

    /**
     * @var array
     */
    public static $fieldDefinition = [
                                      'id'       => '定时任务ID',
                                      'command'  => '定时任务名称',
                                      'param'    => '需要传递的参数',
                                      'schedule' => '执行时间cron表达式',
                                      'status'   => '开启状态',
                                      'remarks'  => '描述备注',
                                     ];
}
