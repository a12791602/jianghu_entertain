<?php

namespace App\Models\Game;

use App\Models\BaseModel;
use App\Models\Systems\StaticResource;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Class GameVendorPlatform
 * @package App\Models\Game
 */
class GameVendorPlatform extends BaseModel
{

    public const DEVICE_H5  = 2;
    public const DEVICE_APP = 3;
    public const DEVICE_PC  = 1;

    /**
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * @return BelongsTo
     */
    public function gameVendor(): BelongsTo
    {
        return $this->belongsTo(GameVendor::class, 'vendor_id', 'id');
    }

    /**
     * Game icon.
     * @return HasOne
     */
    public function icon(): HasOne
    {
        return $this->hasOne(StaticResource::class, 'id', 'icon_id');
    }
}
