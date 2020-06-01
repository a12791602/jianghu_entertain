<?php


namespace App\Models\Activity;

use App\Models\BaseModel;

/**
 * Class ActivitiesConfigRegFirstimeRandom
 * @package App\Models\Activity
 */
class ActivitiesConfigRegFirstimeRandom extends BaseModel
{

    /**
     * @var array $guarded
     */
    protected $guarded = ['id'];

    /**
     * @var array
     */
    public static $fieldDefinition = [
                                      'id'          => '注册送礼活动ID',
                                      'item'        => '奖品',
                                      'probability' => '奖品概率',
                                     ];
}
