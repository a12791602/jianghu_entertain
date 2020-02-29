<?php

namespace App\Models\Activity;

use App\Models\Admin\MerchantAdminUser;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class SystemStaticActivity
 *
 * @package App\Models\Activity
 */
class SystemStaticActivity extends BaseModel
{

    /**
     * @var array $guarded
     */
    protected $guarded = ['id'];
    
    /**
     * @var array
     */
    public static $fieldDefinition = [
                                      'id'         => '活动ID',
                                      'title'      => '活动标题',
                                      'pic'        => '活动图片',
                                      'start_time' => '活动开始时间',
                                      'end_time'   => '活动结束时间',
                                      'status'     => '活动状态',
                                      'device'     => '所属设备',
                                     ];

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
