<?php

namespace App\Models\Game;

use App\ModelFilters\Game\GamesVendorFilter;
use App\Models\Admin\BackendAdminUser;
use App\Models\BaseModel;
use App\Models\Systems\SystemIpWhiteList;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Class GameVendor
 * @package App\Models\Game
 */
class GameVendor extends BaseModel
{

    /**
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
                        'urls'      => 'array',
                        'test_urls' => 'array',
                       ];

    /**
     * @var array
     */
    public static $fieldDefinition = [
                                      'name'                             => '厂商名称',
                                      'sign'                             => '厂商标识',
                                      'type_id'                          => '游戏类型id',
                                      'whitelist_ips'                    => '白名单',
                                      'sort'                             => '排序',
                                      'status'                           => '厂商状态',
                                      'urls'                             => '存放三方调用urls',
                                      'test_urls'                        => '存放三方调用测试urls',
                                      'app_id'                           => '终端号',
                                      'merchant_id'                      => '商户号',
                                      'merchant_secret'                  => '商户密钥',
                                      'public_key'                       => '公钥',
                                      'private_key'                      => '私钥',
                                      'des_key'                          => 'des 密钥',
                                      'md5_key'                          => 'md5 密钥',
                                      'urls.login'                       => '登录接口',
                                      'urls.account_query_url'           => '查询余额接口',
                                      'urls.top_up_url'                  => '上分接口',
                                      'urls.draw_out_url'                => '下分接口',
                                      'urls.order_query_url'             => '查询订单接口',
                                      'urls.user_active_query_url'       => '查询玩家在线状态接口',
                                      'urls.game_order_query_url'        => '查询游戏注单接口',
                                      'urls.user_total_status_query_url' => '查询玩家总分接口',
                                      'urls.kick_out_url'                => '踢玩家接口',
                                      'urls.agent_account_query_url'     => '查询代理余额接口',
                                     ];

    /**
     * @return BelongsTo
     */
    public function lastEditor(): BelongsTo
    {
        return $this->belongsTo(BackendAdminUser::class, 'last_editor_id', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(BackendAdminUser::class, 'author_id', 'id');
    }

    /**
     * @return HasOne
     */
    public function whiteList(): HasOne
    {
        return $this->hasOne(SystemIpWhiteList::class, 'game_vendor_id', 'id');
    }

    /**
     * @param array $value Value.
     * @return void
     */
    public function setWhitelistIpsAttribute(array $value): void
    {
        if (!empty($value)) {
            $this->attributes['whitelist_ips'] = json_encode($value);
        } else {
            $this->attributes['whitelist_ips'] = null;
        }
    }

    /**
     * @param string|null $value Value.
     * @return mixed[]|null
     */
    public function getWhitelistIpsAttribute(?string $value): ?array
    {
        if (!empty($value)) {
            $value = json_decode($value, true);
        }
        return $value;
    }

    /**
     * @return mixed
     */
    public function modelFilter()
    {
        return $this->provideFilter(GamesVendorFilter::class);
    }
}
