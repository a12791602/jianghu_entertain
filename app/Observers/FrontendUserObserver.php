<?php

namespace App\Observers;

use App\Models\Systems\Logics\SystemUserPublicAvatarLogics;
use App\Models\User\FrontendUser;

/**
 * Class FrontendUserObserver
 * @package App\Observers
 */
class FrontendUserObserver
{
    use SystemUserPublicAvatarLogics;

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
        $avatar = $this->avatarRandom();
        $frontendUser->specificInfo()->create(['avatar' => $avatar]);
    }
}
