<?php

namespace App\Models\Systems;

use App\Models\BaseModel;
use App\Models\Systems\Logics\SystemDomainLogics;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class for system domain.
 */
class SystemDomain extends BaseModel
{
    use SystemDomainLogics;

    /**
     * 状态开启
     */
    public const STATUS_OPEN = 1;

    /**
     * 状态关闭
     */
    public const STATUS_CLOSE = 0;


    /**
     * 主域名类型
     */
    public const TYPE_MAIN = 0;

    /**
     * PC域名类型
     */
    public const TYPE_PC = 1;

    /**
     * H5域名类型
     */
    public const TYPE_H5 = 2;

    /**
     * APP域名类型
     */
    public const TYPE_APP = 3;

    /**
     * @var array $guarded
     */
    protected $guarded = ['id'];

    /**
     * 域名类型的前缀
     * @var array
     */
    public $typePrefix = [
                          0 => '',     //主域名不需要前缀
                          1 => 'www.', //PC域名
                          2 => 'm.',   //H5域名
                          3 => 'app.', //APP域名
                         ];

    /**
     * 所属平台
     * @return BelongsTo
     */
    public function platform(): BelongsTo
    {
        return $this->belongsTo(SystemPlatform::class, 'platform_sign', 'sign');
    }
}
