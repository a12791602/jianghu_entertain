<?php

namespace App\Models\Game;

use App\Models\FilterModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class GameVendorPlatform
 * @package App\Models\Game
 */
class GameVendorPlatform extends FilterModel
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
}
