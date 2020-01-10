<?php

namespace App\Models\Platform;

use App\Models\BaseModel;
use App\Models\Game\Game;
use App\Models\Game\GamesType;
use App\Models\Game\GamesVendor;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

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

    public const IS_HOT_YES  = 1;
    public const IS_HOT_NO   = 0;
    public const STATUS_OPEN = 1;

    /**
     * @return BelongsTo
     */
    public function games(): BelongsTo
    {
        $object = $this->belongsTo(Game::class, 'game_sign', 'sign');
        return $object;
    }

    /**
     * @return HasOneThrough
     */
    public function vendor(): HasOneThrough
    {
        $object = $this->hasOneThrough(GamesVendor::class, Game::class, 'sign', 'id', 'game_sign', 'vendor_id');
        return $object;
    }

    /**
     * @return HasOneThrough
     */
    public function type(): HasOneThrough
    {
        $object = $this->hasOneThrough(GamesType::class, Game::class, 'sign', 'id', 'game_sign', 'type_id');
        return $object;
    }
}
