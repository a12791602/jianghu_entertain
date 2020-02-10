<?php

namespace App\Models\User;

use App\ModelFilters\User\FrontendUserFilter;
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

    public const IS_TESTER_YES = 1;
    public const IS_TESTER_NO  = 0;
    public const TYPE_USER     = 1;
    public const TYPE_AGENCY   = 2;

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
                                      'is_online'        => '是否在线',
                                      'device_code'      => '设备',
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
     * Front-end user's bank card.
     * @return HasMany
     */
    public function bankCard(): HasMany
    {
        $result = $this->hasMany(FrontendUsersBankCard::class, 'user_id', 'id');
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
    //    protected $appends = ['mobile_hidden'];

    /**
     * 隐藏手机号中间四位 ****
     * @return string
     */
    public function getMobileHiddenAttribute(): string
    {
        $result = substr_replace($this->mobile, '****', 3, 4);
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

    /**
     * get user withdraw order.
     * @return HasMany
     */
    public function withdraw(): HasMany
    {
        $result = $this->hasMany(UsersWithdrawOrder::class, 'user_id', 'id');
        return $result;
    }

    /**
     * @return mixed
     */
    public function modelFilter()
    {
        $object = $this->provideFilter(FrontendUserFilter::class);
        return $object;
    }
}
