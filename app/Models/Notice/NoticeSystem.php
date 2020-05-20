<?php

namespace App\Models\Notice;

use App\Models\Admin\MerchantAdminUser;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class NoticeSystem
 * @package App\Models\Notice
 */
class NoticeSystem extends BaseModel
{

    /**
     * @var mixed[]
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
                                      'id'         => '系统公告id',
                                      'title'      => '系统公告标题',
                                      'h5_pic_id'  => 'h5系统公告图片id',
                                      'app_pic_id' => 'app系统公告图片id',
                                      'pc_pic_id'  => 'pc系统公告图片id',
                                      'device'     => '系统公告展示设备',
                                      'status'     => '系统公告使用状态',
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
