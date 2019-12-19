<?php

namespace App\Http\SingleActions\Backend\Merchant\User\UserBlackList;

use App\ModelFilters\User\FrontendUsersBlackListFilter;
use App\Models\User\FrontendUsersBlackList;
use Illuminate\Http\JsonResponse;

/**
 * 黑名单详情
 */
class DetailAction
{

    /**
     * @var object
     */
    protected $model;

    /**
     * @param FrontendUsersBlackList $frontendUsersBlackList 用户黑名单Model.
     */
    public function __construct(FrontendUsersBlackList $frontendUsersBlackList)
    {
        $this->model = $frontendUsersBlackList;
    }

    /**
     * @param array $inputDatas 接收的参数.
     * @return JsonResponse
     */
    public function execute(array $inputDatas): JsonResponse
    {
        $data   = $this->model
                     ->filter($inputDatas, FrontendUsersBlackListFilter::class)
                     ->paginate($this->model::getPageSize());
        $msgOut = msgOut(true, $data);
        return $msgOut;
    }
}
