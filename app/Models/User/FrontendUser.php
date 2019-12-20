<?php

namespace App\Models\User;

use App\Models\BaseAuthModel;
use App\Models\Game\GameTypePlatform;
use App\Models\Platform\GamesPlatform;
use App\Models\Systems\SystemPlatform;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Notifications\Notifiable;

/**
 * Class FrontendUser
 *
 * @package App\Models\User
 */
class FrontendUser extends BaseAuthModel
{
    /**
     * Notification
     */
    use Notifiable;

    /**
     * TYPE_TOP_AGENT
     */
    public const TYPE_TOP_AGENT = 1;
    /**
     * TYPE_AGENT
     */
    public const TYPE_AGENT = 2;
    // 没用到  暂时注释
    // const TYPE_USER = 3;
    public const FROZEN_TYPE_NO_WITHDRAWAL = 3;

    /**
     * @var array $guarded
     */
    protected $guarded = ['id'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'fund_password', 'mobile',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'register_time' => 'datetime',
        'last_login_time' => 'datetime',
    ];

    /**
     * 找子级
     *
     * @return HasMany
     */
    public function children(): HasMany
    {
        $result = $this->hasMany($this, 'parent_id', 'id');
        return $result;
    }

    /**
     * 用户上级
     *
     * @return HasOne
     */
    public function parent(): HasOne
    {
        $result = $this->hasOne($this, 'id', 'parent_id');
        return $result;
    }

    /**
     *  用户账户
     *
     * @return HasOne
     */
    public function account(): HasOne
    {
        $result = $this->hasOne(FrontendUsersAccount::class, 'user_id', 'id');
        return $result;
    }

    /**
     *  specific info
     *
     * @return HasOne
     */
    public function specificInfo(): HasOne
    {
        $result = $this->hasOne(FrontendUsersSpecificInfo::class, 'user_id', 'id');
        return $result;
    }

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['mobile_hidden'];

    /**
     * 隐藏手机号中间四位 ****
     * @return string
     */
    public function getMobileHiddenAttribute(): string
    {
        $result = substr_replace($this->attributes['mobile'], '****', 3, 4);
        return $result;
    }

    /**
     * get platform
     * @return HasOne
     */
    public function platform(): HasOne
    {
        $result = $this->hasOne(SystemPlatform::class, 'id', 'platform_id');
        return $result;
    }

    /**
     * get user game_type_platforms
     * @return HasMany
     */
    public function gameTypePlatform(): HasMany
    {
        $result = $this->hasMany(GameTypePlatform::class, 'platform_id', 'platform_id');
        return $result;
    }

    /**
     * get gamesPlatform
     * @return HasOne
     */
    public function gamesPlatform(): HasOne
    {
        $result = $this->hasOne(GamesPlatform::class, 'id', 'platform_id');
        return $result;
    }
}
