<?php

namespace App\Models\Activity;

use App\Models\BaseModel;

/**
 * Class SystemDynActivity
 *
 * @package App\Models\Activity
 */
class ActivitiesDynType extends BaseModel
{

    /**
     * @var array $guarded
     */
    protected $guarded = ['id'];

    /**
     * @var array
     */
    public static $fieldDefinition = [
                                      'id'        => '活动类型ID',
                                      'type_name' => '活动类型',
                                      'name'      => '活动类型标题',
                                     ];
}
