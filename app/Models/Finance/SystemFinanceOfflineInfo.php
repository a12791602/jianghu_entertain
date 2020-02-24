<?php

namespace App\Models\Finance;

use App\Models\Admin\MerchantAdminUser;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class SystemFinanceOfflineInfo
 * @package App\Models\Finance
 */
class SystemFinanceOfflineInfo extends BaseModel
{

    public const STATUS_YES = 1;
    public const STATUS_NO  = 0;

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
                                      'min'            => '最小入款金额',
                                      'max'            => '最大入款金额',
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
        $object = $this->belongsTo(MerchantAdminUser::class, 'last_editor_id', 'id');
        return $object;
    }

    /**
     * @return BelongsTo
     */
    public function author(): BelongsTo
    {
        $object = $this->belongsTo(MerchantAdminUser::class, 'author_id', 'id');
        return $object;
    }

    /**
     * @return BelongsTo
     */
    public function bank(): BelongsTo
    {
        $object = $this->belongsTo(SystemBank::class, 'bank_id', 'id');
        return $object;
    }

    /**
     * @return BelongsTo
     */
    public function type(): BelongsTo
    {
        $object = $this->belongsTo(SystemFinanceType::class, 'type_id', 'id');
        return $object;
    }
}
