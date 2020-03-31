<?php

namespace App\Models\Email;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class SystemEmailOfUser
 *
 * @package App\Models\Email
 */
class SystemEmailOfUser extends BaseModel
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
