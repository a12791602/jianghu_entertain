<?php

namespace App\Models\Systems;

use App\Models\Admin\BackendAdminUser;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * 短信配置
 */
class SystemSmsConfig extends BaseModel
{

    /**
     * @var array $guarded
     */
    protected $guarded = ['id'];

    /**
     * @var array
     */
    public static $fieldDefinition = [
                                      'id'                 => '短信配置ID',
                                      'name'               => '商户名称',
                                      'sign'               => '商户标识',
                                      'merchant_code'      => '商户号',
                                      'merchant_secret'    => '商户密钥',
                                      'public_key'         => '商户公钥',
                                      'sms_num'            => '短信数量',
                                      'authorization_code' => '授权码',
                                      'status'             => '状态',
                                      'updated_at'         => '更新时间',
                                     ];

    /**
     * @return BelongsTo
     */
    public function admin(): BelongsTo
    {
        $admin = $this->belongsTo(BackendAdminUser::class, 'last_editor_id', 'id');
        return $admin;
    }
}
