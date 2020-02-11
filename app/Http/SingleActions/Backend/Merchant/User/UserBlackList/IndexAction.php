<?php

namespace App\Http\SingleActions\Backend\Merchant\User\UserBlackList;

use App\Http\SingleActions\MainAction;
use App\ModelFilters\User\FrontendUsersBlackListFilter;
use App\Models\User\FrontendUsersBlackList;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * 黑名单列表
 */
class IndexAction extends MainAction
{

    /**
     * @var object
     */
    protected $model;

    /**
     * @param FrontendUsersBlackList $frontendUsersBlackList 用户Model.
     * @param Request                $request                Request.
     * @throws \Exception Exception.
     */
    public function __construct(FrontendUsersBlackList $frontendUsersBlackList, Request $request)
    {
        parent::__construct($request);
        $this->model = $frontendUsersBlackList;
    }

    /**
     * @param array $inputDatas 接收的参数.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(array $inputDatas): JsonResponse
    {
        $inputDatas['platformSign'] = $this->currentPlatformEloq->sign;
        $inputDatas['status']       = $this->model::STATUS_BLACK;
        $data                       = $this->model
            ->filter($inputDatas, FrontendUsersBlackListFilter::class)
            ->select(
                [
                 'id',
                 'mobile',
                 'guid',
                 'account',
                 'register_time',
                 'last_login_time',
                 'created_at',
                 'last_login_ip',
                 'remark',
                ],
            )
            ->paginate($this->model::getPageSize());
        $msgOut                     = msgOut($data);
        return $msgOut;
    }
}
