<?php

namespace App\Models\Order;

use App\Models\Admin\MerchantAdminUser;
use App\Models\BaseModel;
use App\Models\Finance\SystemFinanceOnlineInfo;
use App\Models\User\FrontendUser;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Class UsersRechargeOrder
 * @package App\Models\Order
 */
class UsersRechargeOrder extends BaseModel
{

    /**
     * 这是当有一个新订单时初始化的订单状态
     * 对于线下订单此状态代表 审核中
     * 对于线上订单此状态代表 未支付
     */
    public const STATUS_INIT = 0;
    /**
     * 成功上分的订单状态
     * 对于线下订单此状态代表 审核通过
     * 对于线上订单此状态代表 已支付
     */
    public const STATUS_SUCCESS = 1;
    /**
     * 线下订单状态 审核拒绝
     */
    public const STATUS_REFUSE = -1;
    /**
     * 线下订单状态 订单过期
     */
    public const STATUS_EXPIRED = -2;
    /**
     * 线下订单状态 客户确认付款
     */
    public const STATUS_CONFIRM = 3;
    /**
     * 线下订单状态 客户撤销订单
     */
    public const STATUS_CANCEL = -3;
    /**
     * 线下订单有效期 单位 分钟
     */
    public const EXPIRED = 15;

    /**
     * @var array
     */
    protected $guarded = ['id'];

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
                                     ];

    /**
     * @return HasOne
     */
    public function onlineInfo(): HasOne
    {
        return $this->hasOne(SystemFinanceOnlineInfo::class, 'id', 'finance_channel_id');
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
}
