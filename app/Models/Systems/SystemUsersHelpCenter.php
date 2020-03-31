<?php

namespace App\Models\Systems;

use App\Models\Admin\MerchantAdminUser;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * 帮助设置
 */
class SystemUsersHelpCenter extends BaseModel
{

    /**
     * @var array $guarded
     */
    protected $guarded = ['id'];

    /**
     * @var array
     */
    public static $fieldDefinition = [
                                      'id'     => '帮助设置ID',
                                      'pid'    => '上级ID',
                                      'title'  => '帮助设置标题',
                                      'pic'    => '帮助设置图片',
                                      'type'   => '帮助设置所属客户端',
                                      'status' => '帮助设置状态',
                                     ];

    /**
     * 作者
     * @return BelongsTo
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(MerchantAdminUser::class, 'add_admin_id', 'id');
    }

    /**
     * 最后更新人
     * @return BelongsTo
     */
    public function newer(): BelongsTo
    {
        return $this->belongsTo(MerchantAdminUser::class, 'add_admin_id', 'id');
    }

    /**
     * 下级
     * @return HasMany
     */
    public function childs(): HasMany
    {
        return $this->hasMany($this, 'pid', 'id');
    }
}
