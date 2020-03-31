<?php

namespace App\Models\User;

use App\Models\BaseAuthModel;
use App\Models\User\Logics\AccountChangeLogics;
use App\Models\User\Logics\UserAccountLogics;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class FrontendUsersAccount
 *
 * @package App\Models\User
 */
class FrontendUsersAccount extends BaseAuthModel
{
    /**
     * 账户Logics
     */
    use UserAccountLogics;

    /**
     * 账变Logics
     */
    use AccountChangeLogics;

    public const FROZEN_STATUS_OUT       = 1;
    public const FROZEN_STATUS_BACK      = 2;
    public const FROZEN_STATUS_TO_PLAYER = 3;
    public const FROZEN_STATUS_TO_SYSTEM = 4;
    public const FROZEN_STATUS_BONUS     = 5;

    public const MODE_CHANGE_AFTER = 2;
    public const MODE_CHANGE_NOW   = 1;

    /**
     * @var array $guarded
     */
    protected $guarded = ['id'];

    /**
     * @var array
     */
    protected $rechargeTypes = [
                                'recharge',
                                'artificial_recharge',
                               ];

    /**
     * @var array
     */
    protected $activityTypes = ['gift'];
    
    /**
     * 用户信息
     *
     * @return BelongsTo
     */
    public function frontendUser(): BelongsTo
    {
        return $this->belongsTo(FrontendUser::class, 'user_id', 'id');
    }
}
