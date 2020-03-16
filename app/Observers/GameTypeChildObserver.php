<?php

namespace App\Observers;

use App\Models\Game\GameSubType;

/**
 * Class GameTypeChildObserver
 * @package App\Observers
 */
class GameTypeChildObserver
{

    /**
     * Handle the "saving" event of the GameTypeChild model.
     * @param GameSubType $type GameTypeChild Model.
     * @return void
     */
    public function saving(GameSubType $type): void
    {
        $type->last_editor_id = request()->user()->id;
    }
}
