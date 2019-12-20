<?php

namespace App\Models\Finance;

use App\Models\Admin\MerchantAdminUser;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class SystemFinanceOfflineInfo
 * @package App\Models\Finance
 */
class SystemFinanceOfflineInfo extends BaseModel
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
        $object = $this->belongsTo(MerchantAdminUser::class, 'last_editor_id', 'id');
        return $object;
    }

    /**
     * @return BelongsTo
     */
    public function author(): BelongsTo
    {
        $object = $this->belongsTo(MerchantAdminUser::class, 'author_id', 'id');
        return $object;
    }
}
