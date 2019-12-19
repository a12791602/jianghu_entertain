<?php

namespace App\Models\User;

use App\ModelFilters\User\FrontendUsersBlackListFilter;
use App\Models\BaseAuthModel;

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
     * 黑名单次数
     *
     * @return integer
     */
    public function getBlackNumAttribute(): int
    {
        $filterArr = ['uniqueId' => $this->uid];
        $count     = self::filter($filterArr, FrontendUsersBlackListFilter::class)->count();
        return $count;
    }
}
