<?php

namespace App\Models\Email;

use App\Models\Admin\MerchantAdminUser;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class SystemEmailOfMerchant
 *
 * @package App\Models\Email
 */
class SystemEmailOfMerchant extends BaseModel
{

    public const EMAIL_UNREAD = 0;

    /**
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * @var array
     */
    public static $fieldDefinition = ['email_id' => '邮件ID'];

    /**
     * @return BelongsTo
     */
    public function email(): BelongsTo
    {
        return $this->belongsTo(SystemEmail::class, 'email_id', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function merchant(): BelongsTo
    {
        return $this->belongsTo(MerchantAdminUser::class, 'merchant_id', 'id');
    }
}
