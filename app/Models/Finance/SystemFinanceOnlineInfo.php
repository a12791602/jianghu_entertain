<?php

namespace App\Models\Finance;

use App\Models\Admin\MerchantAdminUser;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

/**
 * Class SystemFinanceOnlineInfo
 * @package App\Models\Finance
 */
class SystemFinanceOnlineInfo extends BaseModel
{

    public const ENCRYPT_MODE_SECRET = 1;
    public const ENCRYPT_MODE_CERT   = 2;

    public const STATUS_YES = 1;
    public const STATUS_NO  = 0;

    /**
     * @var array
     */
    protected $guarded = ['id'];

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
        $object = $this->hasOneThrough(
            SystemFinanceType::class,
            SystemFinanceChannel::class,
            'id',
            'id',
            'channel_id',
            'type_id',
        );
        return $object;
    }

    /**
     * @return HasMany
     */
    public function tags(): HasMany
    {
        $object = $this->hasMany(SystemFinanceUserTag::class, 'finance_id', 'id');
        return $object;
    }
}
