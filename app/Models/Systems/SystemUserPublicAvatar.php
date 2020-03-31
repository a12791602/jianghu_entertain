<?php

namespace App\Models\Systems;

use App\Models\BaseModel;
use Illuminate\Support\Facades\App;

/**
 * System user's public avatar.
 * @package App\Models\Systems
 */
class SystemUserPublicAvatar extends BaseModel
{

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
        $avatar         = $this->pic_path;
        $appEnvironment = App::environment();
        return config('image_domain.' . $appEnvironment) . $avatar;
    }
}
