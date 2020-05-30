<?php

namespace App\Models\Report;

use App\Models\BaseAuthModel;
use App\Models\Game\Game;
use App\Models\Report\Logics\ReportDayUserGameCommissionLogics;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * 用户单个游戏洗码日报表
 */
class ReportDayUserGameCommission extends BaseAuthModel
{
    /**
     * ReportDayUserGameCommissionLogics
     */
    use ReportDayUserGameCommissionLogics;

    /**
     * @var array $guarded
     */
    protected $guarded = ['id'];

    /**
     * @var array
     */
    public static $fieldDefinition = [
                                      'guid'             => '会员id',
                                      'game_vendor_sign' => '游戏厂商',
                                     ];

    /**
     * @return BelongsTo
     */
    public function game(): BelongsTo
    {
        return $this->belongsTo(Game::class, 'game_sign', 'sign');
    }
}
