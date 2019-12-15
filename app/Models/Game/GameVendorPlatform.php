<?php

namespace App\Models\Game;

use App\Models\BaseModel;

/**
 * Class GameVendorPlatform
 * @package App\Models\Game
 */
class GameVendorPlatform extends BaseModel
{

    /**
     * @var array
     */
    protected $guarded = ['id'];


    public const DEVICE_H5 = 2;
    public const DEVICE_APP = 3;
    public const DEVICE_PC = 1;

    /**
     * @return mixed
     */
    public function gameVendor()
    {
        return $this->belongsTo(GamesVendor::class, 'vendor_id', 'id');
    }
}
