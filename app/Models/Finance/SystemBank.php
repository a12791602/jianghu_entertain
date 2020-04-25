<?php

namespace App\Models\Finance;

use App\Models\Admin\BackendAdminUser;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class  SystemBank
 *
 * @package App\Models\Finance
 */
class SystemBank extends BaseModel
{

    public const STATUS_OPEN  = 1;
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
                                      'code'   => '银行编码',
                                      'status' => '状态',
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
}
