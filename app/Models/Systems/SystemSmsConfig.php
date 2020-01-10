<?php

namespace App\Models\Systems;

use App\Models\Admin\BackendAdminUser;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * 短信配置
 */
class SystemSmsConfig extends BaseModel
{

    /**
     * @var array $guarded
     */
    protected $guarded = ['id'];

    /**
     * @return BelongsTo
     */
    public function admin(): BelongsTo
    {
        $admin = $this->belongsTo(BackendAdminUser::class, 'last_editor_id', 'id');
        return $admin;
    }
}
