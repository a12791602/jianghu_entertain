<?php

namespace App\Models\Report;

use App\Models\BaseModel;
use App\Models\Report\Logics\ReportDayPlatformLogics;
use App\Models\Systems\SystemPlatform;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * 代理平台日报表
 */
class ReportDayPlatform extends BaseModel
{
    /**
     * ReportDayPlatformLogics
     */
    use ReportDayPlatformLogics;

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
