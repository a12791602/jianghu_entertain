<?php

namespace App\Models\User;

use App\Models\BaseAuthModel;

/**
 * 用户等级规则
 */
class UsersGradesRule extends BaseAuthModel
{

    /**
     * @var array $guarded
     */
    protected $guarded = ['id'];
}
