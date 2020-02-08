<?php

namespace App\Models\Finance;

use App\Models\Admin\MerchantAdminUser;
use App\Models\BaseModel;
use App\Models\User\FrontendUser;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class SystemFinanceHandleSaveBuckleRecord
 * @package App\Models\Finance
 */
class SystemFinanceHandleSaveBuckleRecord extends BaseModel
{

    /**
     * 入款方向
     */
    public const DIRECTION_IN = 1;
    /**
     * 出款方向
     */
    public const DIRECTION_OUT = 0;

    /**
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * @var array
     */
    public static $fieldDefinition = [
                                      'order_no'      => '订单号',
                                      'type'          => '类型',
                                      'user_id'       => '用户id',
                                      'platform_sign' => '平台标记',
                                      'money'         => '金额',
                                      'remark'        => '备注',
                                      'admin_id'      => '操作人id',
                                      'balance'       => '余额',
                                      'desc'          => '金流通道描述',
                                      'direction'     => '方向',
                                      'created_at'    => '创建时间',
                                      'updated_at'    => '更新时间',
                                     ];

    /**
     * 人工存款资金类型.
     *
     * @var array
     */
    public static $saveTypes = [
                                1 => '优惠赠送',
                                2 => '洗码赠送',
                               ];

    /**
     * 人工扣款资金类型.
     *
     * @var array
     */
    public static $buckleTypes = [1 => '误存提款'];

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
    public function user(): BelongsTo
    {
        $object = $this->belongsTo(FrontendUser::class, 'user_id', 'id');
        return $object;
    }
}
