<?php

namespace App\Models\Platform;

use App\Models\BaseModel;
use App\Models\Game\Game;
use App\Models\Game\GameType;
use App\Models\Game\GameVendor;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

/**
 * Class GamePlatform
 *
 * @package App\Models\Platform
 */
class GamePlatform extends BaseModel
{

    public const IS_HOT_YES  = 1;
    public const IS_HOT_NO   = 0;
    public const STATUS_OPEN = 1;

    /**
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * @var array
     */
    public static $fieldDefinition = [
                                      'device'  => '设备类型',
                                      'hot_new' => '是否热门',
                                     ];

    /**
     * @return BelongsTo
     */
    public function games(): BelongsTo
    {
        $object = $this->belongsTo(Game::class, 'game_id', 'id');
        return $object;
    }

    /**
     * @return HasOneThrough
     */
    public function vendor(): HasOneThrough
    {
        $object = $this->hasOneThrough(GameVendor::class, Game::class, 'id', 'id', 'id', 'vendor_id');
        return $object;
    }

    /**
     * @return HasOneThrough
     */
    public function type(): HasOneThrough
    {
        $object = $this->hasOneThrough(GameType::class, Game::class, 'id', 'id', 'id', 'type_id');
        return $object;
    }
}
