<?php

namespace App\Models\Report;

use App\Models\BaseAuthModel;
use App\Models\Game\GameVendor;
use App\Models\Report\Logics\ReportDayUserCommissionLogics;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * 用户单个游戏厂商洗码日报表
 */
class ReportDayUserCommission extends BaseAuthModel
{
    /**
     * ReportDayUserCommissionLogics
     */
    use ReportDayUserCommissionLogics;
    
    /**
     * @var array $guarded
     */
    protected $guarded = ['id'];

    /**
     * @var array
     */
    public static $fieldDefinition = [
                                      'mobile'           => '会员账号',
                                      'guid'             => '会员id',
                                      'game_vendor_sign' => '游戏厂商',
                                     ];

    /**
     * @return BelongsTo
     */
    public function gameVendor(): BelongsTo
    {
        return $this->belongsTo(GameVendor::class, 'game_vendor_sign', 'sign');
    }
}
