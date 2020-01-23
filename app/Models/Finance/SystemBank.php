<?php

namespace App\Models\Finance;

use App\ModelFilters\Finance\SystemBankFilter;
use App\Models\Admin\BackendAdminUser;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class  SystemBank
 *
 * @package App\Models\Finance
 */
class SystemBank extends BaseModel
{

    public const STATUS_OPEN  = 1;
    public const STATUS_CLOSE = 0;

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
     * @return mixed
     */
    public function modelFilter()
    {
        $object = $this->provideFilter(SystemBankFilter::class);
        return $object;
    }
}
