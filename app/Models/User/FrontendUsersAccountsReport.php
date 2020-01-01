<?php

namespace App\Models\User;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * 用户帐变记录
 */
class FrontendUsersAccountsReport extends BaseModel
{

    /**
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * @return HasOne
     */
    public function changeType(): HasOne
    {
        $data = $this->hasOne(FrontendUsersAccountsType::class, 'sign', 'type_sign');
        return $data;
    }
}
