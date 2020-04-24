<?php

namespace App\Models\Admin;

use App\Models\FilterModel;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class for marchant admin access group.
 */
class MerchantAdminAccessGroup extends FilterModel
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
     * @var array
     */
    public static $fieldDefinition = [
                                      'id'         => '管理员组ID',
                                      'group_name' => '管理员组名称',
                                     ];

    /**
     * 管理员组权限
     *
     * @return HasMany
     */
    public function detail(): HasMany
    {
        return $this->hasMany(MerchantAdminAccessGroupsHasBackendSystemMenu::class, 'group_id', 'id');
    }

    /**
     * @return HasMany
     */
    public function adminUsers(): HasMany
    {
        return $this->hasMany(MerchantAdminUser::class, 'group_id', 'id');
    }
}
