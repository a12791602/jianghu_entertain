<?php

namespace App\Models\User;

use App\Models\User\Logics\FrontendUsersAccountsTypeLogics;
use Illuminate\Database\Eloquent\Model;

/**
 * Class FrontendUsersAccountsType
 * @package App\Models\User
 */
class FrontendUsersAccountsType extends Model
{
    /**
     * 帐变类型Logics
     */
    use FrontendUsersAccountsTypeLogics;

    /**
     * @var array $guarded
     */
    protected $guarded = ['id'];
}
