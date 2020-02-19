<?php

namespace App\Models\User;

use App\Models\Admin\MerchantAdminUser;
use App\Models\BaseAuthModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class UsersWithdrawOrder
 * @package App\Models\User
 */
class UsersWithdrawOrder extends BaseAuthModel
{

    /**
     * 审核中.
     */
    public const STATUS_CHECK_INIT = 0;
    /**
     * 审核通过.
     */
    public const STATUS_CHECK_PASS = 1;
    /**
     * 审核拒绝.
     */
    public const STATUS_CHECK_REFUSE = -1;
    /**
     * 出款成功.
     */
    public const STATUS_OUT_SUCESS = 2;
    /**
     * 拒绝出款.
     */
    public const STATUS_OUT_REFUSE = -2;
    /**
     * 银行卡.
     */
    public const TYPE_BANK = 1;
    /**
     * 支付宝.
     */
    public const TYPE_ALIPAY = 2;
    /**
     * 微信.
     */
    public const TYPE_WECHAT = 3;

    /**
     * @var array $guarded
     */
    protected $guarded = ['id'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['account_snap' => 'array'];

    /**
     * @var array
     */
    public static $fieldDefinition = [
                                      'platform_sign'   => '平台标识',
                                      'order_no'        => '订单号',
                                      'mobile'          => '会员账号',
                                      'user_id'         => '用户ID',
                                      'amount'          => '提现金额',
                                      'before_balance'  => '提现前余额',
                                      'handing_fee'     => '手续费',
                                      'audit_fee'       => '稽核扣款',
                                      'amount_received' => '到账金额',
                                      'account_type'    => '收款账户类型',
                                      'is_audit'        => '是否稽核扣款',
                                      'status'          => '订单状态',
                                      'month_total'     => '当月存款总额',
                                      'num_withdrawal'  => '当月存款总额',
                                      'num_top_up'      => '今日存款次数',
                                      'reviewer_id'     => '审核人ID',
                                      'operation_at'    => '操作时间',
                                      'review_at'       => '审核时间',
                                      'account_snap'    => '收款账户快照',
                                      'remark'          => '备注',
                                      'admin_id'        => '操作人ID',
                                     ];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        $object = $this->belongsTo(FrontendUser::class, 'user_id', 'id');
        return $object;
    }

    /**
     * @return BelongsTo
     */
    public function admin(): BelongsTo
    {
        $object = $this->belongsTo(MerchantAdminUser::class, 'admin_id', 'id');
        return $object;
    }

    /**
     * @return BelongsTo
     */
    public function reviewer(): BelongsTo
    {
        $object = $this->belongsTo(MerchantAdminUser::class, 'reviewer_id', 'id');
        return $object;
    }

    /**
     * @param string|null $value Value.
     * @return mixed[]|null
     */
    public function getAccountSnapAttribute(?string $value): ?array
    {
        if (!empty($value) && isJson($value)) {
            $value = json_decode($value, true);
            return $value;
        }
        return null;
    }

    /**
     * The "booting" method of the model
     * @return void
     */
    protected static function boot(): void
    {
        parent::boot();
        static::creating(
            static function ($model) {
                $model->order_no = static::availableOrderNo();
                if (!$model->order_no) {
                    return false;
                }
            },
        );
    }

    /**
     * Get available order no.
     * @return string
     * @throws \Exception Exception.
     */
    public static function availableOrderNo(): string
    {
        $prefix = date('YmdHis');
        for ($i = 0; $i < 10; $i++) {
            $order_no = $prefix . str_pad(strval(random_int(0, 999999)), 6, '0', STR_PAD_LEFT);
            if (!static::query()->select('order_no')->where('order_no', $order_no)->exists()) {
                return $order_no;
            }
        }
    }
}
