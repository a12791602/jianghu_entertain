<?php

namespace App\Models\Finance;

use App\Models\Admin\MerchantAdminUser;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Class SystemFinanceOfflineInfo
 * @package App\Models\Finance
 */
class SystemFinanceOfflineInfo extends BaseModel
{

    public const STATUS_YES = 1;
    public const STATUS_NO  = 0;

    public const FINANCE_TYPE_BANK = 1;

    /**
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * @var array
     */
    public static $fieldDefinition = [
                                      'id'             => 'ID',
                                      'type_id'        => '分类id',
                                      'platform_id'    => '平台id',
                                      'bank_id'        => '银行id',
                                      'name'           => '名称',
                                      'remark'         => '备注',
                                      'qrcode'         => '二维码',
                                      'account'        => '入款帐号',
                                      'username'       => '入款姓名',
                                      'min_amount'     => '最小入款金额',
                                      'max_amount'     => '最大入款金额',
                                      'sort'           => '排序',
                                      'status'         => '状态',
                                      'pay_type'       => '支付类型',
                                      'branch'         => '支行',
                                      'author_id'      => '添加人id',
                                      'last_editor_id' => '最后编辑人id',
                                      'fee'            => '手续费',
                                     ];

    /**
     * @return BelongsTo
     */
    public function lastEditor(): BelongsTo
    {
        return $this->belongsTo(MerchantAdminUser::class, 'last_editor_id', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(MerchantAdminUser::class, 'author_id', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function bank(): BelongsTo
    {
        return $this->belongsTo(SystemBank::class, 'bank_id', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function type(): BelongsTo
    {
        return $this->belongsTo(SystemFinanceType::class, 'type_id', 'id');
    }

    /**
     * @return HasOne
     */
    public function tags(): HasOne
    {
        return $this->hasOne(SystemFinanceUserTag::class, 'offline_finance_id', 'id');
    }
}
