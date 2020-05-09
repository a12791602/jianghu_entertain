<?php

namespace App\Models\User;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * 用户帐变记录
 */
class FrontendUsersAccountsReport extends BaseModel
{
    public const FROZEN_STATUS_NOT       = 0; //与冻结无关
    public const FROZEN_STATUS_OUT       = 1; //冻结
    public const FROZEN_STATUS_BACK      = 2; //解冻
    public const FROZEN_STATUS_TO_PLAYER = 3;
    public const FROZEN_STATUS_TO_SYSTEM = 4; //消耗冻结资金

    /**
     * @var array
     */
    protected $guarded = ['id'];
    
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['params' => 'array'];

    /**
     * @var array
     */
    public static $fieldDefinition = ['created_at' => '账变时间'];

    /**
     * @return HasOne
     */
    public function changeType(): HasOne
    {
        return $this->hasOne(FrontendUsersAccountsType::class, 'sign', 'type_sign');
    }

    /**
     * 用户
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(FrontendUser::class, 'user_id', 'id');
    }
}
