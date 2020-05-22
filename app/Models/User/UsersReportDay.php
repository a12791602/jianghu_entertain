<?php

namespace App\Models\User;

use App\Models\BaseAuthModel;

/**
 * 用户日报表
 */
class UsersReportDay extends BaseAuthModel
{

    /**
     * @var array $guarded
     */
    protected $guarded = ['id'];
}
