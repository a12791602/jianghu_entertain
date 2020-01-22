<?php

namespace App\Models\Email;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class SystemEmailOfMerchant
 *
 * @package App\Models\Email
 */
class SystemEmailOfMerchant extends BaseModel
{

    /**
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * @return BelongsTo
     */
    public function email(): BelongsTo
    {
        $object = $this->belongsTo(SystemEmail::class, 'email_id', 'id');
        return $object;
    }
}
