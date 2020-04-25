<?php

namespace App\Models\Email;

use App\Models\Admin\BackendAdminUser;
use App\Models\Admin\MerchantAdminUser;
use App\Models\FilterModel;
use App\Models\Systems\SystemPlatform;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class SystemEmail
 *
 * @package App\Models\Email
 */
class SystemEmail extends FilterModel
{

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
     * 已读
     */
    public const IS_READ_YES = 1;

    /**
     * 未读
     */
    public const IS_READ_NO = 0;

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
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * @var array
     */
    public static $fieldDefinition = [
                                      'is_timing'     => '是否定时发送',
                                      'is_send'       => '是否发送',
                                      'title'         => '邮件标题',
                                      'content'       => '邮件内容',
                                      'send_time'     => '发送时间',
                                      'type'          => '邮件类型',
                                      'receiver_ids'  => '接收人IDs',
                                      'receivers'     => '接收人',
                                      'sender_id'     => '发送人ID',
                                      'platform_sign' => '平台标记',
                                      'created_at'    => '创建时间',
                                      'updated_at'    => '更新时间',
                                     ];

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
        return $this->belongsTo(BackendAdminUser::class, 'sender_id', 'id');
    }

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
    public function platform(): BelongsTo
    {
        return $this->belongsTo(SystemPlatform::class, 'platform_sign', 'sign');
    }
}
