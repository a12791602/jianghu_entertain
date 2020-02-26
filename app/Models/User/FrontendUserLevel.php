<?php

namespace App\Models\User;

use App\Models\BaseAuthModel;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * 用户等级
 */
class FrontendUserLevel extends BaseAuthModel
{

    /**
     * @var array $guarded
     */
    protected $guarded = ['id'];

    /**
     * @return HasMany
     */
    public function user(): HasMany
    {
        $users = $this->hasMany(FrontendUser::class, 'grade_id', 'id');
        return $users;
    }
}
