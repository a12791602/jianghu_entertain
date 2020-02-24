<?php

namespace App\Models\Finance;

use App\Models\Admin\MerchantAdminUser;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

/**
 * Class SystemFinanceOnlineInfo
 * @package App\Models\Finance
 */
class SystemFinanceOnlineInfo extends BaseModel
{

    public const ENCRYPT_MODE_SECRET = 1;
    public const ENCRYPT_MODE_CERT   = 2;

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
                                      'id'              => 'ID',
                                      'frontend_name'   => '前台备注',
                                      'frontend_remark' => '前台备注',
                                      'backend_name'    => '后台名称',
                                      'backend_remark'  => '后台备注',
                                      'platform_sign'   => '平台标识',
                                      'channel_id'      => '所属通道id',
                                      'min'             => '最小入款金额',
                                      'max'             => '最大入款金额',
                                      'handle_fee'      => '手续费',
                                      'rebate_fee'      => '返利',
                                      'request_url'     => '请求地址',
                                      'back_url'        => '返回地址',
                                      'merchant_code'   => '商户号',
                                      'merchant_secret' => '商户密钥',
                                      'public_key'      => '第三方公钥',
                                      'private_key'     => '第三方私钥',
                                      'app_ip'          => '终端号',
                                      'vendor_url'      => '第三方域名',
                                      'status'          => '状态',
                                      'merchant_no'     => '商户编号',
                                      'desc'            => '充值说明',
                                      'encrypt_mode'    => '加密方式',
                                      'certificate'     => '证书',
                                      'author_id'       => '创建人id',
                                      'last_editor_id'  => '最后编辑人id',
                                     ];

    /**
     * @return BelongsTo
     */
    public function channel(): BelongsTo
    {
        $object = $this->belongsTo(SystemFinanceChannel::class, 'channel_id', 'id');
        return $object;
    }

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
     * @return HasOneThrough
     */
    public function type(): HasOneThrough
    {
        $object = $this->hasOneThrough(
            SystemFinanceType::class,
            SystemFinanceChannel::class,
            'id',
            'id',
            'channel_id',
            'type_id',
        );
        return $object;
    }
}
