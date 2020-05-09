<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class FrontendUsersAccountsTypesGroup
 * @package App\Models\User
 */
class FrontendUsersAccountsTypesGroup extends Model
{

    /**
     * @var array $guarded
     */
    protected $guarded = ['id'];

    /**
     * 账变类型
     * @return HasMany
     */
    public function accountType(): HasMany
    {
        return $this->hasMany(FrontendUsersAccountsType::class, 'group_type_id', 'id');
    }
}
