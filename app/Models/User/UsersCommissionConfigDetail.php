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
     * @var array
     */
    public static $fieldDefinition = ['percent' => '洗码比例'];

    /**
     * @return mixed
     */
    public function userGrade()
    {
        $userGrade = $this->belongsTo(FrontendUserLevel::class, 'grade_id', 'id');
        return $userGrade;
    }
}
