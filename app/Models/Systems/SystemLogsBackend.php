<?php

namespace App\Models\Systems;

use App\Models\DeveloperUsage\Backend\SystemRoutesBackend;
use App\Models\FilterModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * 后台系统日志
 */
class SystemLogsBackend extends FilterModel
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
                                      'data_ip'    => 'IP',
                                      'created_at' => '操作时间',
                                      'admin_name' => '管理员名称',
                                     ];

    /**
     * 所属路由
     * @return BelongsTo
     */
    public function route(): BelongsTo
    {
        return $this->belongsTo(SystemRoutesBackend::class, 'route_id', 'id');
    }
}
