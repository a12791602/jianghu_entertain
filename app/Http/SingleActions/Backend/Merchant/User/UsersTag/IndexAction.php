<?php

namespace App\Http\SingleActions\Backend\Merchant\User\UsersTag;

use App\ModelFilters\User\UsersTagFilter;
use App\Models\User\UsersTag;
use Illuminate\Http\JsonResponse;

/**
 * 用户标签列表
 */
class IndexAction
{

    /**
     * @var object
     */
    protected $model;

    /**
     * @param UsersTag $usersTag 用户标签Model.
     */
    public function __construct(UsersTag $usersTag)
    {
        $this->model = $usersTag;
    }

    /**
     * @param string $sign 平台标识.
     * @return JsonResponse
     */
    public function execute(string $sign): JsonResponse
    {
        $filterArr = ['platformSign' => $sign];
        $data      = $this->model
                          ->filter($filterArr, UsersTagFilter::class)
                          ->get()
                          ->toArray();
        $msgOut    = msgOut(true, $data);
        return $msgOut;
    }
}
