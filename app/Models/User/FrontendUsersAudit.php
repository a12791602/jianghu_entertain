<?php

namespace App\Models\User;

use App\Models\BaseModel;
use App\Models\User\Logics\FrontendUsersAuditLogics;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * 会员稽核
 */
class FrontendUsersAudit extends BaseModel
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

    /**
     * 用户
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(FrontendUser::class, 'guid', 'guid');
    }
}
