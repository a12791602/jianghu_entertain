<?php

namespace App\Models\User;

use App\Models\BaseAuthModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * 用户黑名单
 */
class FrontendUsersBlackList extends BaseAuthModel
{

    public const STATUS_BLACK = 0;

    public const STATUS_WHITE = 1;

    /**
     * @var array $guarded
     */
    protected $guarded = ['id'];

    /**
     * @var array $appends
     */
    protected $appends = ['black_num'];
    
    /**
     * @var array
     */
    public static $fieldDefinition = [
                                      'id'     => '黑名单ID',
                                      'mobile' => '会员账号',
                                      'guid'   => '用户UID',
                                      'remark' => '备注',
                                      'status' => '黑名单状态',
                                     ];

    /**
     * 黑名单次数
     *
     * @return integer
     */
    public function getBlackNumAttribute(): int
    {
        $filterArr = ['guid' => $this->guid];
        return self::filter($filterArr)->count();
    }

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(FrontendUser::class, 'guid', 'guid');
    }
}
