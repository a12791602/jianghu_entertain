<?php

namespace App\Models\User;

use App\Models\BaseAuthModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class FrontendUsersAccount
 *
 * @package App\Models\User
 */
class FrontendUsersAccount extends BaseAuthModel
{

    /**
     * @var array $guarded
     */
    protected $guarded = ['id'];

    /**
     * 用户信息
     *
     * @return BelongsTo
     */
    public function frontendUser(): BelongsTo
    {
        $result = $this->belongsTo(FrontendUser::class, 'user_id', 'account_id');
        return $result;
    }
}
