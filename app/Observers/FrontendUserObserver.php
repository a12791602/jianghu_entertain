<?php

namespace App\Observers;

use App\Models\User\FrontendUser;

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
    }
}
