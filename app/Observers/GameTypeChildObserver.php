<?php

namespace App\Observers;

use App\Models\Game\GameTypeChild;

/**
 * Class GameTypeChildObserver
 * @package App\Observers
 */
class GameTypeChildObserver
{

    /**
     * Handle the "saving" event of the GameTypeChild model.
     * @param GameTypeChild $type GameTypeChild Model.
     * @return void
     */
    public function saving(GameTypeChild $type): void
    {
        $type->last_editor_id = request()->user()->id;
    }
}
