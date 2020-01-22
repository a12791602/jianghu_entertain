<?php

namespace App\Models\Email;

use App\ModelFilters\Email\SystemEmailFilter;
use App\Models\Admin\BackendAdminUser;
use App\Models\Admin\MerchantAdminUser;
use App\Models\BaseModel;
use App\Models\Systems\SystemPlatform;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class SystemEmail
 *
 * @package App\Models\Email
 */
class SystemEmail extends BaseModel
{

    /**
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * 立即发送
     *
     */
    public const IS_TIMING_NO = 0;

    /**
     * 延时发送
     *
     */
    public const IS_TIMING_YES = 1;

    /**
     * 已发送
     *
     */
    public const IS_SEND_YES = 1;

    /**
     * 未发送
     *
     */
    public const IS_SEND_NO = 0;

    /**
     * 厅主发往总控
     *
     */
    public const TYPE_MER_TO_HEAD = 1;

    /**
     * 厅主发往会员
     *
     */
    public const TYPE_MER_TO_USER = 2;

    /**
     * 总控发往厅主
     *
     */
    public const TYPE_HEAD_TO_MER = 3;

    /**
     * @param string $value Value.
     * @return mixed[]
     */
    public function getReceiverIdsAttribute(?string $value): array
    {
        $data = [];
        if (isset($value)) {
            $data = json_decode($value, true);
        }
        return $data;
    }

    /**
     * @param string $value Value.
     * @return mixed[]
     */
    public function getReceiversAttribute(?string $value): array
    {
        $data = [];
        if (isset($value)) {
            $data = json_decode($value, true);
        }
        return $data;
    }

    /**
     * @param array $value Value.
     * @return void
     */
    public function setReceiversAttribute(array $value): void
    {
        $this->attributes['receivers'] = json_encode($value);
    }

    /**
     * @return BelongsTo
     */
    public function headquarters(): BelongsTo
    {
        $object = $this->belongsTo(BackendAdminUser::class, 'sender_id', 'id');
        return $object;
    }

    /**
     * @return BelongsTo
     */
    public function merchant(): BelongsTo
    {
        $object = $this->belongsTo(MerchantAdminUser::class, 'sender_id', 'id');
        return $object;
    }

    /**
     * @return BelongsTo
     */
    public function platform(): BelongsTo
    {
        $object = $this->belongsTo(SystemPlatform::class, 'platform_sign', 'sign');
        return $object;
    }

    /**
     * @return mixed
     */
    public function modelFilter()
    {
        $object = $this->provideFilter(SystemEmailFilter::class);
        return $object;
    }
}
