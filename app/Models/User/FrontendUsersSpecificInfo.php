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
     * 状态开启
     */
    public const PROMOTION_GIFT_OPEN = 1;

    /**
     * 状态关闭
     */
    public const PROMOTION_GIFT_CLOSE = 0;

    /**
     * 状态开启
     */
    public const WEEKLY_GIFT_OPEN = 1;

    /**
     * 状态关闭
     */
    public const WEEKLY_GIFT_CLOSE = 0;

    /**
     * @var array $guarded
     */
    protected $guarded = ['id'];

    /**
     * Get the user's full avatar URL.
     *
     * @return string
     */
    public function getAvatarFullAttribute(): string
    {
        $avatar         = optional(SystemUserPublicAvatar::find($this->avatar))->pic_path;
        $appEnvironment = App::environment();
        if ($avatar) {
            $result = config('image_domain.' . $appEnvironment) . $avatar;
        } else {
            $result = config('image_domain.' . $appEnvironment) . SystemUserPublicAvatar::first()->pic_path;
        }
        return $result;
    }
}
