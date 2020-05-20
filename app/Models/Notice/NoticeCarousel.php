<?php

namespace App\Models\Notice;

use App\Models\Admin\MerchantAdminUser;
use App\Models\BaseModel;
use App\Models\Systems\StaticResource;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Class NoticeCarousel
 * @package App\Models\Notice
 */
class NoticeCarousel extends BaseModel
{

    public const TYPE_INSIDE = 1;
    public const TYPE_OUTER  = 2;

    /**
     * @var mixed[]
     */
    protected $guarded = ['id'];

    /**
     * @var array
     */
    public static $fieldDefinition = [
                                      'id'         => '公告id',
                                      'title'      => '公告标题',
                                      'pic_id'     => '图片id',
                                      'type'       => '轮播类型',
                                      'link'       => '跳转地址',
                                      'start_time' => '开始时间',
                                      'end_time'   => '结束时间',
                                      'status'     => '状态',
                                      'device'     => '设备',
                                     ];

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

    /**
     * Get Pic
     *
     * @return string
     */
    public function getPicAttribute(): string
    {
        $result = $this->getPicPath($this->picPath);
        unset($this->picPath);
        return $result;
    }

    /**
     * @param StaticResource|null $eloqPath EloqPath.
     * @return boolean|mixed
     */
    protected function getPicPath(?StaticResource $eloqPath)
    {
        if ($eloqPath instanceof StaticResource) {
            return getJHHYUrl($eloqPath->path, 'resources');
        }
        return false;
    }

    /**
     * Banner PicPath.
     * @return HasOne
     */
    public function picPath(): HasOne
    {
        return $this->hasOne(StaticResource::class, 'id', 'pic_id');
    }
}
