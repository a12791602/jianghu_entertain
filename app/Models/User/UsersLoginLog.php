<?php

namespace App\Models\User;

use App\Models\BaseAuthModel;

/**
 * 用户登陆记录
 */
class UsersLoginLog extends BaseAuthModel
{

    /**
     * @var array $guarded
     */
    protected $guarded = ['id'];
}
