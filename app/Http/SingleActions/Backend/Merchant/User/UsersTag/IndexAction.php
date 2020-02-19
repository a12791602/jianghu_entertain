<?php

namespace App\Http\SingleActions\Backend\Merchant\User\UsersTag;

use App\Http\SingleActions\MainAction;
use App\ModelFilters\User\UsersTagFilter;
use App\Models\User\UsersTag;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * 用户标签列表
 */
class IndexAction extends MainAction
{

    /**
     * @var object
     */
    protected $model;

    /**
     * @param UsersTag $usersTag 用户标签Model.
     * @param Request  $request  Request.
     * @throws \Exception Exception.
     */
    public function __construct(UsersTag $usersTag, Request $request)
    {
        parent::__construct($request);
        $this->model = $usersTag;
    }

    /**
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(): JsonResponse
    {
        $sign      = $this->currentPlatformEloq->sign;
        $filterArr = ['platformSign' => $sign];
        $data      = $this->model
                          ->filter($filterArr, UsersTagFilter::class)
                          ->select('id', 'title', 'no_withdraw', 'no_login', 'no_play', 'no_promote', 'created_at')
                          ->paginate($this->model::getPageSize());
        $msgOut    = msgOut($data);
        return $msgOut;
    }
}
