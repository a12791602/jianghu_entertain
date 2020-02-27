<?php

namespace App\Models\Activity;

use App\ModelFilters\Activity\SystemDynActivityFilter;
use App\Models\Admin\BackendAdminUser;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class SystemDynActivity
 *
 * @package App\Models\Activity
 */
class SystemDynActivity extends BaseModel
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
        $object = $this->belongsTo(BackendAdminUser::class, 'last_editor_id', 'id');
        return $object;
    }

    /**
     * @return mixed
     */
    public function modelFilter()
    {
        $object = $this->provideFilter(SystemDynActivityFilter::class);
        return $object;
    }
}
