<?php

namespace App\Models\User;

use App\Models\BaseAuthModel;

/**
 * 用户登陆记录
 */
class UsersLoginLog extends BaseAuthModel
{

    /**
     * @var array $guarded
     */
    protected $guarded = ['id'];

    /**
     * @var array
     */
    public static $fieldDefinition = [
                                      'mobile'        => '会员账号(手机)',
                                      'guid'          => '会员UID',
                                      'create_at'     => '登录日期',
                                      'last_login_ip' => '登录IP',
                                     ];
}
