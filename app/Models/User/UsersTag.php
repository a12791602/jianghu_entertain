<?php

namespace App\Models\User;

use App\Models\BaseAuthModel;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class UsersTag
 * @package App\Models\User
 */
class UsersTag extends BaseAuthModel
{

    /**
     * @var array $guarded
     */
    protected $guarded = ['id'];

    /**
     * @var array
     */
    public static $fieldDefinition = [
                                      'id'          => '标签ID',
                                      'title'       => '标签名称',
                                      'no_withdraw' => '禁止出款选项',
                                      'no_login'    => '禁止登录选项',
                                      'no_play'     => '禁止游戏选项',
                                      'no_promote'  => '禁止推广选项',
                                     ];

    /**
     * 标签下的会员
     * @return HasMany
     */
    public function user(): HasMany
    {
        $users = $this->hasMany(FrontendUser::class, 'user_tag_id', 'id');
        return $users;
    }
}
