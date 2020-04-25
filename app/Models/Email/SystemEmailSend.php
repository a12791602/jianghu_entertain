<?php

namespace App\Models\Email;

use App\Models\Admin\MerchantAdminUser;
use App\Models\FilterModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class SystemEmailSend
 *
 * @package App\Models\Email
 */
class SystemEmailSend extends FilterModel
{

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
    public function merchant(): BelongsTo
    {
        return $this->belongsTo(MerchantAdminUser::class, 'sender_id', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function email(): BelongsTo
    {
        return $this->belongsTo(SystemEmail::class, 'email_id', 'id');
    }
}
