<?php

namespace App\Models\User;

use App\Models\Admin\MerchantAdminUser;
use App\Models\BaseModel;
use App\Models\Finance\SystemFinanceOfflineInfo;
use App\Models\Finance\SystemFinanceOnlineInfo;
use App\Models\Finance\SystemFinanceType;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Class UsersRechargeOrder
 * @package App\Models\Order
 */
class UsersRechargeOrder extends BaseModel
{

    /**
     * 线下订单 初始化到缓存 还未确认
     * 对于线上订单此状态代表 未支付
     */
    public const STATUS_INIT = 0;
    /**
     * 线下订单状态 客户确认付款
     * 对于后台 线下订单此状态代表 待审核
     */
    public const STATUS_CONFIRM = 1;
    /**
     * 对于线下订单此状态代表 审核通过
     * 对于线上订单此状态代表 已支付
     */
    public const STATUS_SUCCESS = 2;
    /**
     * 线下订单状态 审核拒绝
     */
    public const STATUS_REFUSE = 3;
    /**
     * 线下订单状态 客户撤销订单
     */
    public const STATUS_CANCEL = 4;

    /**
     * 线下订单有效期 单位 分钟
     */
    public const STATUS_EXPIRED = 15;

    /**
     * 线下支付
     */
    public const OFFLINE_FINANCE = 0;

    /**
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['finance_type_name'];

    /**
     * @var array
     */
    public static $fieldDefinition = [
                                      'platform_sign'      => '平台标记',
                                      'order_no'           => '订单号',
                                      'platform_no'        => '第三方订单号',
                                      'platform_need_no'   => '第三方需要的订单号',
                                      'user_id'            => '用户ID',
                                      'finance_type_id'    => '金流类型id',
                                      'finance_channel_id' => '充值渠道ID',
                                      'money'              => '订单金额',
                                      'real_money'         => '真实付款金额',
                                      'discount_money'     => '优惠金额',
                                      'handling_money'     => '手续费',
                                      'arrive_money'       => '到帐金额',
                                      'status'             => '状态',
                                      'admin_id'           => '操作人ID',
                                      'is_online'          => '是否是线上存款',
                                      'remark'             => '备注',
                                      'client_ip'          => '下单IP',
                                      'snap_merchant_no'   => '商户编号快照',
                                      'snap_merchant_code' => '商户号快照',
                                      'snap_merchant'      => '商户快照',
                                      'snap_finance_type'  => '支付方式快照',
                                      'snap_user_grade'    => '会员等级快照',
                                      'snap_account'       => '收款账户快照',
                                      'snap_bank'          => '收款银行快照',
                                      'branch'             => '入款支行',
                                      'bank'               => '入款银行',
                                      'card_number'        => '入款卡号',
                                     ];

    /**
     * @return HasOne
     */
    public function onlineInfo(): HasOne
    {
        return $this->hasOne(SystemFinanceOnlineInfo::class, 'id', 'finance_channel_id');
    }

    /**
     * @return HasOne
     */
    public function offlineInfo(): HasOne
    {
        return $this->hasOne(SystemFinanceOfflineInfo::class, 'id', 'finance_channel_id');
    }

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(FrontendUser::class, 'user_id', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function admin(): BelongsTo
    {
        return $this->belongsTo(MerchantAdminUser::class, 'admin_id', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function financeType(): BelongsTo
    {
        return $this->belongsTo(SystemFinanceType::class, 'finance_type_id', 'id');
    }

    /**
     * 充值类型名称
     * @return string
     */
    public function getFinanceTypeNameAttribute(): string
    {
        return $this->financeType->name ?? '';
    }
}
