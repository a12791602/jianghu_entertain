<?php

namespace App\Models\User;

use App\Models\BaseAuthModel;

/**
 * 用户等级
 */
class FrontendUserLevel extends BaseAuthModel
{

    /**
     * @var array $guarded
     */
    protected $guarded = ['id'];

    /**
     * @var array
     */
    public static $fieldDefinition = [
                                      'id'             => '等级ID',
                                      'name'           => '等级名称',
                                      'experience_min' => '等级最小经验值',
                                      'experience_max' => '等级最大经验值',
                                      'level_gift'     => '晋级奖励',
                                      'weekly_gift'    => '周奖励',
                                     ];
}
