<?php

namespace App\Models\Systems;

use App\Models\Admin\MerchantAdminUser;
use App\Models\FilterModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * 推广图片
 */
class SystemPromotionPic extends FilterModel
{

    /**
     * @var array $guarded
     */
    protected $guarded = ['id'];

    /**
     * @var array
     */
    public static $fieldDefinition = [
                                      'id'     => '推广图片ID',
                                      'pic'    => '推广图片',
                                      'type'   => '帮助设置所属客户端',
                                      'status' => '推广图片状态',
                                      'device' => '客户端类型',
                                     ];

    /**
     * 作者
     * @return BelongsTo
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(MerchantAdminUser::class, 'author_id', 'id');
    }

    /**
     * 最后更新人
     * @return BelongsTo
     */
    public function newer(): BelongsTo
    {
        return $this->belongsTo(MerchantAdminUser::class, 'last_editor_id', 'id');
    }
}
