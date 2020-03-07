<?php

namespace App\Models\User;

use App\Models\BaseAuthModel;
use App\Models\User\Logics\FrontendUsersAuditLogics;

/**
 * 会员稽核
 */
class FrontendUsersAudit extends BaseAuthModel
{
    /**
     * 用户稽核Logics
     */
    use FrontendUsersAuditLogics;
    
    /**
     * @var array $guarded
     */
    protected $guarded = ['id'];

    /**
     * @var array
     */
    public static $fieldDefinition = [
                                      'mobile'     => '用户账号(手机)',
                                      'guid'       => '用户ID',
                                      'status'     => '稽核状态',
                                      'created_at' => '生成时间',
                                     ];
}
