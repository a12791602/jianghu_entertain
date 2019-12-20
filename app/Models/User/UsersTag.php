<?php

namespace App\Models\User;

use App\Models\BaseAuthModel;

/**
 * Class UsersTag
 * @package App\Models\User
 */
class UsersTag extends BaseAuthModel
{

    /**
     * @var array $guarded
     */
    protected $guarded = ['id'];
}
