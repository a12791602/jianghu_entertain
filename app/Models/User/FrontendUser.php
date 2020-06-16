<?php

namespace App\Models\User;

use App\Models\BaseAuthModel;
use App\Models\Game\GamePlatform;
use App\Models\Game\GameTypePlatform;
use App\Models\Systems\SystemPlatform;
use App\Models\User\Logics\FrontendUserLogics;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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
     * FrontendUserLogics
     */
    use FrontendUserLogics;

    public const IS_TESTER_YES = 1;
    public const IS_TESTER_NO  = 0;
    public const TYPE_USER     = 1;
    public const TYPE_AGENCY   = 2;
    // 是否设置了资金密码 0否 1是
    public const FUND_PASSWORD_SET   = 1;
    public const FUND_PASSWORD_UNSET = 0;

    /**
     *  账户状态->正常
     */
    public const STATUS_NORMAL = 1;
    /**
     *  账户状态->禁用
     */
    public const STATUS_DISABLE = 0;

    /**
     * @var array $guarded
     */
    protected $guarded = ['id'];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['mobile_hidden'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
                         'password',
                         'remember_token',
                         'fund_password',
                        ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
                        'rid'             => 'array',
                        'register_time'   => 'datetime',
                        'last_login_time' => 'datetime',
                       ];

    /**
     * @var array
     */
    public static $fieldDefinition = [
                                      'username'         => '用户名',
                                      'mobile'           => '手机号码',
                                      'guid'             => '用户唯一标识UID',
                                      'top_id'           => '最上级id',
                                      'parent_id'        => '上级id',
                                      'platform_id'      => '平台id',
                                      'platform_sign'    => '平台标识',
                                      'account_id'       => 'account表id',
                                      'type'             => '用户类型',
                                      'grade_id'         => 'vip等级id',
                                      'is_tester'        => '是否测试用户',
                                      'password'         => '密码',
                                      'fund_password'    => '资金密码',
                                      'security_code'    => '安全码',
                                      'remember_token'   => 'token',
                                      'level_deep'       => '用户等级深度',
                                      'register_ip'      => '注册IP',
                                      'last_login_ip'    => '最后登陆IP',
                                      'last_login_time'  => '最后登陆时间',
                                      'user_specific_id' => '用户扩展信息表id',
                                      'user_tag_id'      => '用户标签id',
                                      'status'           => '状态',
                                      'invite_code'      => '邀请码',
                                      'is_online'        => '在线状态',
                                      'device_code'      => '设备',
                                      'create_at'        => '注册时间',
                                     ];

    /**
     * 找子级
     *
     * @return HasMany
     */
    public function children(): HasMany
    {
        return $this->hasMany($this, 'parent_id', 'id');
    }

    /**
     * 用户上级
     *
     * @return HasOne
     */
    public function parent(): HasOne
    {
        return $this->hasOne($this, 'id', 'parent_id');
    }

    /**
     *  用户账户
     *
     * @return HasOne
     */
    public function account(): HasOne
    {
        return $this->hasOne(FrontendUsersAccount::class, 'user_id', 'id');
    }

    /**
     * Front-end user's bank card.
     * @return HasMany
     */
    public function bankCard(): HasMany
    {
        return $this->hasMany(FrontendUsersBankCard::class, 'user_id', 'id');
    }

    /**
     *  specific info
     *
     * @return HasOne
     */
    public function specificInfo(): HasOne
    {
        return $this->hasOne(FrontendUsersSpecificInfo::class, 'user_id', 'id');
    }

    /**
     * 隐藏手机号中间四位 ****
     * @return string
     */
    public function getMobileHiddenAttribute(): string
    {
        return substr_replace((string) $this->mobile, '****', 3, 4);
    }

    /**
     * get platform
     * @return HasOne
     */
    public function platform(): HasOne
    {
        return $this->hasOne(SystemPlatform::class, 'id', 'platform_id');
    }

    /**
     * get user game_type_platforms
     * @return HasMany
     */
    public function gameTypePlatform(): HasMany
    {
        return $this->hasMany(GameTypePlatform::class, 'platform_id', 'platform_id');
    }

    /**
     * get gamesPlatform
     * @return HasOne
     */
    public function gamesPlatform(): HasOne
    {
        return $this->hasOne(GamePlatform::class, 'id', 'platform_id');
    }

    /**
     * get user withdraw order.
     * @return HasMany
     */
    public function withdraw(): HasMany
    {
        return $this->hasMany(UsersWithdrawOrder::class, 'user_id', 'id');
    }

    /**
     * 用户标签
     * @return BelongsTo
     */
    public function userTag(): BelongsTo
    {
        return $this->belongsTo(UsersTag::class, 'user_tag_id', 'id');
    }

    /**
     * @return HasMany
     */
    public function levelBenefits(): HasMany
    {
        return $this->hasMany(FrontendUserLevelBenefit::class, 'user_id', 'id');
    }
}
