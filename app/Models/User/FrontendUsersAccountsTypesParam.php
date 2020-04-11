<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;

/**
 * Class FrontendUsersAccountsTypesParam
 * @package App\Models\User
 */
class FrontendUsersAccountsTypesParam extends Model
{

    public const SEARCH_EASE_NO  = 0; //不常用搜索，放入params字段保存
    public const SEARCH_EASE_YES = 1; //常用搜索，放入表字段保存

    /**
     * @var array $guarded
     */
    protected $guarded = ['id'];
}
