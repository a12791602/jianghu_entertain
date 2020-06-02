<?php


namespace App\Models\Activity;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class ActivitiesDynPlatform
 * @package App\Models\Activity
 */
class ActivitiesDynPlatform extends BaseModel
{

    /**
     * @var array $guarded
     */
    protected $guarded = ['id'];

    /**
     * @var array
     */
    public static $fieldDefinition = [
                                      'activity_dyn_id' => '动态活动Id',
                                      'status'          => '活动状态',
                                     ];

    /**
     * @return BelongsTo
     */
    public function activitySystem(): BelongsTo
    {
        return $this->belongsTo(ActivitiesDynSystem::class, 'activity_dyn_id', 'id');
    }
}
