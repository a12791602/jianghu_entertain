<?php

namespace App\Models\User;

use App\Models\BaseAuthModel;

/**
 * 用户日报表
 */
class UsersReportDay extends BaseAuthModel
{

    /**
     * @var array $guarded
     */
    protected $guarded = ['id'];

    /**
     * @var array
     */
    public static $fieldDefinition = [
                                      'mobile' => '会员账号(手机)',
                                      'guid'   => '会员UID',
                                     ];
}
