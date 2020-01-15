<?php

namespace App\Models\Admin;

use App\ModelFilters\Admin\MerchantAdminUserFilter;
use App\Models\BaseAuthModel;
use App\Models\Systems\SystemPlatform;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Class for marchant admin user.
 */
class MerchantAdminUser extends BaseAuthModel
{

    public const STATUS_CLOSE = 0;
    public const STATUS_OPEN  = 1;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
                         'password',
                         'remember_token',
                        ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['email_verified_at' => 'datetime'];

    /**
     * 平台
     *
     * @return HasOne
     */
    public function platform(): HasOne
    {
        $platform = $this->hasOne(SystemPlatform::class, 'sign', 'platform_sign');
        return $platform;
    }

    /**
     * 角色组
     *
     * @return HasOne
     */
    public function accessGroup(): HasOne
    {
        $accessGroup = $this->hasOne(MerchantAdminAccessGroup::class, 'id', 'group_id');
        return $accessGroup;
    }

    /**
     * @return string
     */
    public function modelFilter(): string
    {
        $string = $this->provideFilter(MerchantAdminUserFilter::class);
        return $string;
    }
}
