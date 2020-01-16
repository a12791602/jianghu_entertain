<?php

namespace App\Models\Finance;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class  SystemPlatformBank
 *
 * @package App\Models\Finance
 */
class SystemPlatformBank extends BaseModel
{

    /**
     * 状态开启
     *
     */
    public const STATUS_OPEN = 1;

    /**
     * 状态关闭
     *
     */
    public const STATUS_CLOSE = 0;
    
    /**
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * @return BelongsTo
     */
    public function bank(): BelongsTo
    {
        $object = $this->belongsTo(SystemBank::class, 'bank_id', 'id');
        return $object;
    }
}
