<?php

namespace App\Models\Systems;

use App\Models\BaseModel;
use App\Models\Systems\Logics\SystemPlatformReportDayLogics;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * 代理平台日报表
 */
class SystemPlatformReportDay extends BaseModel
{
    /**
     * SystemPlatformReportDayLogics
     */
    use SystemPlatformReportDayLogics;

    /**
     * @var array $guarded
     */
    protected $guarded = ['id'];

    /**
     * @var array
     */
    public static $fieldDefinition = [];

    /**
     * 所属平台
     * @return BelongsTo
     */
    public function platform(): BelongsTo
    {
        return $this->belongsTo(SystemPlatform::class, 'platform_sign', 'sign');
    }
}
