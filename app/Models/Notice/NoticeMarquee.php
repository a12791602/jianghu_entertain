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
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['device' => 'array'];

    /**
     * @var array
     */
    public static $fieldDefinition = [
                                      'id'         => '跑马灯id',
                                      'title'      => '跑马灯标题',
                                      'content'    => '跑马灯内容',
                                      'device'     => '跑马灯展示设备',
                                      'status'     => '跑马灯使用状态',
                                      'start_time' => '开始时间',
                                      'end_time'   => '结束时间',
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
}
