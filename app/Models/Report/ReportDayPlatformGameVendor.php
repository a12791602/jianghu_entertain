<?php

namespace App\Models\Report;

use App\Models\BaseModel;
use App\Models\Report\Logics\ReportDayPlatformGameVendorLogics;
use App\Models\Systems\SystemPlatform;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class ReportDayPlatformGameVendor
 *
 * @package App\Models\Report
 */
class ReportDayPlatformGameVendor extends BaseModel
{
    /**
     * ReportDayPlatformGameVendorLogics
     */
    use ReportDayPlatformGameVendorLogics;

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
