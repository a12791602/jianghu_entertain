<?php

namespace App\Models\Notice;

use App\Models\Admin\MerchantAdminUser;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class NoticeCarousel
 * @package App\Models\Notice
 */
class NoticeCarousel extends BaseModel
{

    /**
     * @var mixed[]
     */
    protected $guarded = ['id'];

    public const TYPE_INSIDE = 1;
    public const TYPE_OUTER  = 2;

    /**
     * @return BelongsTo
     */
    public function lastEditor(): BelongsTo
    {
        $object = $this->belongsTo(MerchantAdminUser::class, 'last_editor_id', 'id');
        return $object;
    }

    /**
     * @return BelongsTo
     */
    public function author(): BelongsTo
    {
        $object = $this->belongsTo(MerchantAdminUser::class, 'author_id', 'id');
        return $object;
    }
}
