<?php

namespace App\Models\User;

use App\Models\BaseAuthModel;
use App\Models\Systems\SystemUserPublicAvatar;
use Illuminate\Support\Facades\App;

/**
 * Class FrontendUsersSpecificInfo
 *
 * @package App\Models\User
 */
class FrontendUsersSpecificInfo extends BaseAuthModel
{

    /**
     * 用户等级初始化
     */
    public const LEVEL_INITIALIZATION = 0;

    /**
     * @var array $guarded
     */
    protected $guarded = ['id'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['g_active' => 'array'];

    /**
     * @return string
     */
    public function getAvatarFullAttribute(): string
    {
        $appEnvironment = App::environment();
        $avatarClass    = SystemUserPublicAvatar::class;
        $avatarEloq     = $avatarClass::find($this->avatar);
        if ($avatarEloq !== null) {
            $avatar_pic = $avatarEloq->pic_path;
        } else {
            $avatarEloq = $avatarClass::first();
            $avatar_pic = optional($avatarEloq)->pic_path;
        }
        return config('image_domain.' . $appEnvironment) . $avatar_pic;
    }
}
