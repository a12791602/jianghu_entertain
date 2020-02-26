<?php

namespace App\Models\User;

use App\Models\BaseModel;

/**
 * Class UsersCommissionConfigDetail
 * @package App\Models\User
 */
class UsersCommissionConfigDetail extends BaseModel
{

    /**
     * @var array $guarded
     */
    protected $guarded = ['id'];

    /**
     * @return mixed
     */
    public function userGrade()
    {
        $userGrade = $this->belongsTo(FrontendUserLevel::class, 'grade_id', 'id');
        return $userGrade;
    }
}
