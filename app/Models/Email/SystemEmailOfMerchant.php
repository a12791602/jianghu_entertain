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
        $object = $this->belongsTo(SystemEmail::class, 'email_id', 'id');
        return $object;
    }

    /**
     * @return BelongsTo
     */
    public function merchant(): BelongsTo
    {
        $object = $this->belongsTo(MerchantAdminUser::class, 'merchant_id', 'id');
        return $object;
    }
}
