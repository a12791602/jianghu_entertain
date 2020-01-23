<?php

namespace App\Models\Admin;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class for marchant admin access group.
 */
class MerchantAdminAccessGroup extends BaseModel
{
    public const IS_SUPER = 1;
    public const NO_SUPER = 0;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * 管理员组权限
     *
     * @return HasMany
     */
    public function detail(): HasMany
    {
        $detail = $this->hasMany(MerchantAdminAccessGroupsHasBackendSystemMenu::class, 'group_id', 'id');
        return $detail;
    }

    /**
     * @return HasMany
     */
    public function adminUsers(): HasMany
    {
        $adminUsers = $this->hasMany(MerchantAdminUser::class, 'group_id', 'id');
        return $adminUsers;
    }
}
