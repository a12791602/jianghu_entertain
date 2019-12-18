<?php

namespace App\Models\Platform;

use App\Models\BaseModel;
use App\Models\Game\Game;
use App\Models\Game\GamesType;
use App\Models\Game\GamesVendor;

/**
 * Class GamesPlatform
 *
 * @package App\Models\Platform
 */
class GamesPlatform extends BaseModel
{

    /**
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * @return object
     */
    public function games(): object
    {
        $object = $this->belongsTo(Game::class, 'game_sign', 'sign');
        return $object;
    }

    /**
     * @return object
     */
    public function vendor(): object
    {
        $object = $this->hasOneThrough(GamesVendor::class, Game::class, 'sign', 'id', 'game_sign', 'vendor_id');
        return $object;
    }

    /**
     * @return object
     */
    public function type(): object
    {
        $object = $this->hasOneThrough(GamesType::class, Game::class, 'sign', 'id', 'game_sign', 'type_id');
        return $object;
    }
}
