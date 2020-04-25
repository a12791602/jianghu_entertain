<?php

namespace App\Models\Activity;

use App\Models\Admin\BackendAdminUser;
use App\Models\FilterModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class SystemDynActivity
 *
 * @package App\Models\Activity
 */
class SystemDynActivity extends FilterModel
{

    /**
     * @var array $guarded
     */
    protected $guarded = ['id'];

    /**
     * @var array
     */
    public static $fieldDefinition = [
                                      'id'     => '活动ID',
                                      'status' => '状态',
                                      'name'   => '活动名称',
                                     ];

    /**
     * @return BelongsTo
     */
    public function lastEditor(): BelongsTo
    {
        return $this->belongsTo(BackendAdminUser::class, 'last_editor_id', 'id');
    }
}
