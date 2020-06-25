<?php

namespace App\Models\Report;

use App\Models\BaseModel;
use App\Models\Game\Game;
use App\Models\Game\GameVendor;
use App\Models\Report\Logics\ReportDayUserGameLogics;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class ReportDayUserGame
 *
 * @package App\Models\Report
 */
class ReportDayUserGame extends BaseModel
{
    /**
     * ReportDayUserGameLogics
     */
    use ReportDayUserGameLogics;

    /**
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * @var array
     */
    public static $fieldDefinition = [
                                      'game_vendor_sign' => '游戏厂商标识',
                                      'game_name'        => '游戏名称',
                                     ];

    /**
     * 游戏
     * @return BelongsTo
     */
    public function game(): BelongsTo
    {
        return $this->belongsTo(Game::class, 'game_sign', 'sign');
    }

    /**
     * 游戏厂商
     * @return BelongsTo
     */
    public function gameVendor(): BelongsTo
    {
        return $this->belongsTo(GameVendor::class, 'game_vendor_sign', 'sign');
    }
}
