<?php

namespace App\Models\User;

use App\Models\BaseModel;
use App\Models\User\Logics\FrontendUsersAccountsTypeLogics;

/**
 * Class FrontendUsersAccountsType
 * @package App\Models\User
 */
class FrontendUsersAccountsType extends BaseModel
{
    /**
     * 帐变类型Logics
     */
    use FrontendUsersAccountsTypeLogics;

    public const FRONTEND_DISPLAY_NO  = 0; //前台不显示（部分只操作冻结金额的记录不需要给用户看到）
    public const FRONTEND_DISPLAY_YES = 1; //前台显示
    
    /**
     * @var array $guarded
     */
    protected $guarded = ['id'];
}
