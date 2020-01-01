<?php

namespace App\Models\Finance;

use App\Models\Admin\MerchantAdminUser;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

/**
 * Class SystemFinanceOnlineInfo
 * @package App\Models\Finance
 */
class SystemFinanceOnlineInfo extends BaseModel
{

    /**
     * @var array
     */
    protected $guarded = ['id'];

    public const ENCRYPT_MODE_SECRET = 1;
    public const ENCRYPT_MODE_CERT   = 2;

    /**
     * @return BelongsTo
     */
    public function channel(): BelongsTo
    {
        $object = $this->belongsTo(SystemFinanceChannel::class, 'channel_id', 'id');
        return $object;
    }

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

    /**
     * @return HasOneThrough
     */
    public function type(): HasOneThrough
    {
        $object = $this->hasOneThrough(SystemFinanceType::class, SystemFinanceChannel::class, 'channel_id', 'type_id');
        return $object;
    }
}
