<?php

namespace App\Observers;

use App\Models\Systems\SystemUserPublicAvatar;
use App\Models\User\FrontendUser;
use Illuminate\Support\Arr;

/**
 * Class FrontendUserObserver
 * @package App\Observers
 */
class FrontendUserObserver
{
    /**
     * Handle the frontend user "created" event.
     *
     * @param  FrontendUser $frontendUser FrontendUser Model.
     * @return void
     */
    public function created(FrontendUser $frontendUser): void
    {
        $frontendUser->account()->create(['status' => 1]);

        // Generate random avatars for users.
        $systemAvatars = SystemUserPublicAvatar::pluck('id')->toArray();
        $avatar        = Arr::random(Arr::wrap($systemAvatars));
        $frontendUser->specificInfo()->create(['avatar' => $avatar]);
    }
}
