<?php

namespace App\Models\Systems;

use App\Models\BaseModel;
use App\Models\User\FrontendUser;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * 前台系统日志
 */
class SystemLogsFrontend extends BaseModel
{
    public const PHONE    = 1;
    public const DESKSTOP = 2;
    public const ROBOT    = 3;
    public const MOBILE   = 4;
    public const TABLET   = 5;
    public const OTHER    = 6;

    /**
     * @var array $guarded
     */
    protected $guarded = ['id'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
                        'inputs' => 'array',
                        'route'  => 'array',
                       ];

    /**
     * @var array
     */
    public static $fieldDefinition = [
                                      'created_at' => '登陆日期',
                                      'moble'      => '会员账号',
                                     ];

    /**
     * 用户
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(FrontendUser::class, 'user_id', 'id');
    }
}
