<?php

namespace App\Models\Finance;

use App\Models\Admin\BackendAdminUser;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

/**
 * Class SystemFinanceType
 * @package App\Models\Finance
 */
class SystemFinanceType extends BaseModel
{

    public const IS_ONLINE_YES = 1;
    public const IS_ONLINE_NO  = 0;

    public const STATUS_YES = 1;
    public const STATUS_NO  = 0;

    public const DIRECTION_IN  = 1;
    public const DIRECTION_OUT = 0;

    /**
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * @var array
     */
    public static $fieldDefinition = [
                                      'name'           => '金流分类名称',
                                      'sign'           => '金流分类标记',
                                      'is_online'      => '是否是线上金流',
                                      'direction'      => '金流方向',
                                      'status'         => '金流分类状态',
                                      'author_id'      => '创建人ID',
                                      'last_editor_id' => '最后编辑人ID',
                                      'created_at'     => '创建时间',
                                      'updated_at'     => '更新时间',
                                     ];

    /**
     * @return BelongsTo
     */
    public function lastEditor(): BelongsTo
    {
        return $this->belongsTo(BackendAdminUser::class, 'last_editor_id', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(BackendAdminUser::class, 'author_id', 'id');
    }

    /**
     * @return HasManyThrough
     */
    public function onlineInfos(): HasManyThrough
    {
        return $this->hasManyThrough(
            SystemFinanceOnlineInfo::class,
            SystemFinanceChannel::class,
            'type_id',
            'channel_id',
        );
    }

    /**
     * @return HasMany
     */
    public function offlineInfos(): HasMany
    {
        return $this->hasMany(SystemFinanceOfflineInfo::class, 'type_id', 'id');
    }
}
