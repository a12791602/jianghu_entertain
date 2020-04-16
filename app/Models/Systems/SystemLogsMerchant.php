<?php

namespace App\Models\Systems;

use App\Models\BaseModel;

/**
 * 后台系统日志
 */
class SystemLogsMerchant extends BaseModel
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
    // public function route(): BelongsTo
    // {
    //     return $this->belongsTo(SystemRoutesMerchant::class, 'route_id', 'id');
    // }
}
