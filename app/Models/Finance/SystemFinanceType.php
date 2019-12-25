<?php

namespace App\Models\Finance;

use App\Models\Admin\BackendAdminUser;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class SystemFinanceType
 * @package App\Models\Finance
 */
class SystemFinanceType extends BaseModel
{

    /**
     * @var array
     */
    protected $guarded = ['id'];

    public const IS_ONLINE_YES = 1;
    public const IS_ONLINE_NO  = 0;

    public const STATUS_YES = 1;
    public const STATUS_NO  = 0;

    /**
     * @return BelongsTo
     */
    public function lastEditor(): BelongsTo
    {
        $object = $this->belongsTo(BackendAdminUser::class, 'last_editor_id', 'id');
        return $object;
    }

    /**
     * @return BelongsTo
     */
    public function author(): BelongsTo
    {
        $object = $this->belongsTo(BackendAdminUser::class, 'author_id', 'id');
        return $object;
    }
}
