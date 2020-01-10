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
        $account = $frontendUser->account()->create([]);

        $frontendUser->account_id = $account->id;
        $frontendUser->update();
    }
}
