<?php

namespace App\Models\Admin;

use App\Models\BaseAuthModel;
use App\Models\Systems\SystemPlatform;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Notifications\Notifiable;

/**
 * Class for backend admin user.
 */
class BackendAdminUser extends BaseAuthModel
{
    use Notifiable;

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
     * @var array
     */
    public static $fieldDefinition = [
                                      'id'       => '管理员ID',
                                      'name'     => '管理员名称',
                                      'email'    => '管理员帐号',
                                      'password' => '管理员密码',
                                      'group_id' => '管理员组ID',
                                      'status'   => '管理员状态',
                                     ];

    // Rest omitted for brevity

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return mixed
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    /**
     * 平台
     *
     * @return HasOne
     */
    public function platform(): HasOne
    {
        return $this->hasOne(SystemPlatform::class, 'id', 'platform_id');
    }

    /**
     * 角色组
     *
     * @return HasOne
     */
    public function accessGroup(): HasOne
    {
        return $this->hasOne(BackendAdminAccessGroup::class, 'id', 'group_id');
    }
}
