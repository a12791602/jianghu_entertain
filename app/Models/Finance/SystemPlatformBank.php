<?php

namespace App\Models\Finance;

use App\Models\Admin\MerchantAdminUser;
use App\Models\FilterModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class  SystemPlatformBank
 *
 * @package App\Models\Finance
 */
class SystemPlatformBank extends FilterModel
{

    /**
     * 状态开启
     *
     */
    public const STATUS_OPEN = 1;

    /**
     * 状态关闭
     *
     */
    public const STATUS_CLOSE = 0;
    
    /**
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * @var array
     */
    public static $fieldDefinition = [
                                      'id'     => '银行ID',
                                      'name'   => '银行名称',
                                      'status' => '银行状态',
                                     ];

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
    public function lastEditor(): BelongsTo
    {
        return $this->belongsTo(MerchantAdminUser::class, 'last_editor_id', 'id');
    }
}
