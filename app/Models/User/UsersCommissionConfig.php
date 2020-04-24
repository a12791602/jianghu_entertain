<?php

namespace App\Models\User;

use App\Models\FilterModel;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class UsersCommissionConfig
 * @package App\Models\User
 */
class UsersCommissionConfig extends FilterModel
{

    /**
     * @var array $guarded
     */
    protected $guarded = ['id'];

    /**
     * @var array
     */
    public static $fieldDefinition = [
                                      'id'             => '洗码配置ID',
                                      'game_type_id'   => '游戏类型ID',
                                      'game_vendor_id' => '洗码厂商ID',
                                      'bet'            => '打码量',
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
