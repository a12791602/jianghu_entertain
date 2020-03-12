<?php

namespace App\Models\User;

use App\Models\BaseAuthModel;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
                                      'promotion_gift' => '晋级奖励',
                                      'weekly_gift'    => '周奖励',
                                     ];

    /**
     * 属于该等级的用户
     * @return HasMany
     */
    public function users(): HasMany
    {
        $users = $this->hasMany(FrontendUser::class, 'level_id', 'id');
        return $users;
    }
}
