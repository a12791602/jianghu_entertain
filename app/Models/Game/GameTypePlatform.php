<?php

namespace App\Models\Game;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class GameTypePlatform
 *
 * @package App\Models\Game
 */
class GameTypePlatform extends BaseModel
{

    /**
     * @var array
     */
    protected $guarded = ['id'];

    public const DEVICE_H5  = 2;
    public const DEVICE_APP = 3;
    public const DEVICE_PC  = 1;
    public const STATUS     = 1;

    /**
     * @return BelongsTo
     */
    public function gameType(): BelongsTo
    {
        $object = $this->belongsTo(GamesType::class, 'type_id', 'id');
        return $object;
    }
}
