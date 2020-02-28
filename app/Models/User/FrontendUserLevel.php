<?php

namespace App\Models\User;

use App\Models\BaseAuthModel;

/**
 * 用户等级
 */
class FrontendUserLevel extends BaseAuthModel
{

    /**
     * @var array $guarded
     */
    protected $guarded = ['id'];
}
