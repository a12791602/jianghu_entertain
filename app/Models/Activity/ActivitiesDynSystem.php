<?php

namespace App\Models\Activity;

use App\Models\Admin\BackendAdminUser;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Class SystemDynActivity
 *
 * @package App\Models\Activity
 */
class ActivitiesDynSystem extends BaseModel
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

    /**
     * 获取对应活动的 Model
     * @return mixed
     */
    public function getModelClassAttribute()
    {
        $acConfigClassName = 'App\\Models\\Activity\\' . $this->model;
        return new $acConfigClassName();
    }

    /**
     * 获取对应活动的 Model
     * @return mixed
     */
    public function getActivityClassAttribute()
    {
        if (isset($this->type)) {
            $acConfigClassName = 'App\\' . ucfirst($this->type->type_title) . '\\' . $this->title;
            $param             = ['activity' => $this];
            return resolve($acConfigClassName, $param);
        }
        return null;
    }

    /**
     * @return HasOne
     */
    public function type(): HasOne
    {
        return $this->hasOne(ActivitiesDynType::class, 'id', 'type_id');
    }
}
