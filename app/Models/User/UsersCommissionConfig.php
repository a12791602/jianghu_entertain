<?php

namespace App\Models\User;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class UsersCommissionConfig
 * @package App\Models\User
 */
class UsersCommissionConfig extends BaseModel
{

    /**
     * @var array $guarded
     */
    protected $guarded = ['id'];

    /**
     * @var array
     */
    public static $fieldDefinition = [
                                      'id'               => '洗码配置ID',
                                      'game_type_sign'   => '游戏类型',
                                      'game_vendor_sign' => '洗码厂商',
                                      'bet'              => '打码量',
                                     ];

    /**
     * 洗码设置详情
     * @return HasMany
     */
    public function configDetail(): HasMany
    {
        return $this->hasMany(UsersCommissionConfigDetail::class, 'config_id', 'id');
    }
}
