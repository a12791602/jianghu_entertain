<?php

namespace App\Models\Game;

use App\Models\BaseModel;
use App\Models\Game\Logics\GameProjectLogics;
use App\Models\User\FrontendUser;
use App\Models\User\FrontendUserLevel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Game
 * @package App\Models\Game
 */
class GameProject extends BaseModel
{
    use GameProjectLogics;


    public const STATUS_BET           = 0;//0已投注
    public const STATUS_CANCEL        = 1;//1已撤销
    public const STATUS_LOSE          = 2;//2未中奖
    public const STATUS_WIN           = 3;//3已中奖
    public const STATUS_WIN_CALCULATE = 4;//4已派奖
    public const PULL_STATUS_NO       = 0;//0未拉取第三方状态
    public const PULL_STATUS_YES      = 1;//1已拉取第三方状态
    public const COUNTED_REPORT_NO    = 0;//0未计入报表
    public const COUNTED_REPORT_YES   = 1;//1以计入报表

    /**
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * @var array
     */
    public static $fieldDefinition = [
                                      'guid'              => '用户ID',
                                      'serial_number'     => '注单号',
                                      'status'            => '状态',
                                      'game_vendor_sign'  => '游戏厂商',
                                      'their_create_time' => '注单时间',
                                      'delivery_time'     => '派彩时间',
                                      'created_at'        => '入库时间',
                                     ];

    /**
     * 用户
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(FrontendUser::class, 'user_id', 'id');
    }

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

    /**
     * 等级
     * @return BelongsTo
     */
    public function userLevel(): BelongsTo
    {
        return $this->belongsTo(FrontendUserLevel::class, 'vip_level_id', 'id');
    }
}
