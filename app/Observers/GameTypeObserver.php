<?php

namespace App\Observers;

use App\Models\Game\GameType;

/**
 * Class GameTypeObserver
 * @package App\Observers
 */
class GameTypeObserver
{

    /**
     * Handle the "saving" event of the GameType model.
     * @param GameType $type GameType Model.
     * @return void
     */
    public function saving(GameType $type): void
    {
        $type->last_editor_id = request()->user()->id;
    }
}
