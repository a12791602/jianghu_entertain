<?php

namespace App\Models\User;

use App\Models\BaseAuthModel;

/**
 * 用户等级规则
 */
class FrontendUserLevelRule extends BaseAuthModel
{

    /**
     * @var array $guarded
     */
    protected $guarded = ['id'];

    /**
     * @var array
     */
    public static $fieldDefinition = [
                                      'recharge' => '充值金额',
                                      'bet'      => '打码量',
                                      'type'     => '等级规则类型',
                                     ];
}
