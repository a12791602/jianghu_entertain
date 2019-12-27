<?php

namespace App\Models\User;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class UsersCommissionConfig
 * @package App\Models\User
 */
class UsersCommissionConfig extends BaseModel
{

    /**
     * @var array $guarded
     */
    protected $guarded = ['id'];

    /**
     * 洗码设置详情
     * @return HasMany
     */
    public function configDetail(): HasMany
    {
        $detail = $this->hasMany(UsersCommissionConfigDetail::class, 'config_id', 'id');
        return $detail;
    }
}
