<?php

namespace App\Models\Report;

use App\Models\BaseAuthModel;
use App\Models\Game\GameVendor;
use App\Models\Report\Logics\ReportDayGameVendorLogics;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * 游戏厂商日总报表
 */
class ReportDayGameVendor extends BaseAuthModel
{
    /**
     * ReportDayGameVendorLogics
     */
    use ReportDayGameVendorLogics;
    
    /**
     * @var array $guarded
     */
    protected $guarded = ['id'];

    /**
     * @var array
     */
    public static $fieldDefinition = ['game_vendor_sign' => '游戏厂商'];

    /**
     * 游戏厂商
     * @return BelongsTo
     */
    public function gameVendor(): BelongsTo
    {
        return $this->belongsTo(GameVendor::class, 'game_vendor_sign', 'sign');
    }
}
