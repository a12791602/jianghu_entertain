<?php

namespace App\Models\Finance;

use App\Models\Admin\BackendAdminUser;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class SystemFinanceChannel
 * @package App\Models\Finance
 */
class SystemFinanceChannel extends BaseModel
{

    /**
     * @var array
     */
    protected $guarded = ['id'];

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

    /**
     * @return BelongsTo
     */
    public function vendor(): BelongsTo
    {
        $object = $this->belongsTo(SystemFinanceVendor::class, 'vendor_id', 'id');
        return $object;
    }

    /**
     * @return BelongsTo
     */
    public function type(): BelongsTo
    {
        $object = $this->belongsTo(SystemFinanceType::class, 'type_id', 'id');
        return $object;
    }
}
