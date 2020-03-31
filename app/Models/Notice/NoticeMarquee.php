<?php

namespace App\Models\Notice;

use App\Models\Admin\MerchantAdminUser;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class NoticeMarquee
 * @package App\Models\Notice
 */
class NoticeMarquee extends BaseModel
{

    /**
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * @param mixed[] $value Value.
     * @return void
     */
    public function setDeviceAttribute(array $value): void
    {
        $this->attributes['device'] = json_encode($value);
    }

    /**
     * @param string $value Value.
     * @return mixed[]
     */
    public function getDeviceAttribute(string $value): array
    {
        $data = [];
        if (!empty($value)) {
            $data = json_decode($value, true);
        }
        return $data;
    }

    /**
     * @return BelongsTo
     */
    public function lastEditor(): BelongsTo
    {
        return $this->belongsTo(MerchantAdminUser::class, 'last_editor_id', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(MerchantAdminUser::class, 'author_id', 'id');
    }
}
