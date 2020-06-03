<?php

namespace App\Models\Game;

use App\Models\BaseModel;
use App\Models\Game\Logics\GameVendorReportDayLogics;
use App\Models\Systems\SystemPlatform;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class GameVendorReportDay
 *
 * @package App\Models\Game
 */
class GameVendorReportDay extends BaseModel
{
    /**
     * GameVendorReportDayLogics
     */
    use GameVendorReportDayLogics;

    /**
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * @var array
     */
    public static $fieldDefinition = ['game_vendor_name' => '游戏厂商'];

    /**
     * 所属平台
     * @return BelongsTo
     */
    public function platform(): BelongsTo
    {
        return $this->belongsTo(SystemPlatform::class, 'platform_sign', 'sign');
    }
}
