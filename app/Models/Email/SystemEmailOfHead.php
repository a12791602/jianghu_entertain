<?php

namespace App\Models\Email;

use App\Models\FilterModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class SystemEmailOfHead
 *
 * @package App\Models\Email
 */
class SystemEmailOfHead extends FilterModel
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
        return $this->belongsTo(SystemEmail::class, 'email_id', 'id');
    }
}
