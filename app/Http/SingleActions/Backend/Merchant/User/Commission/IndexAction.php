<?php

namespace App\Http\SingleActions\Backend\Merchant\User\Commission;

use App\Http\SingleActions\MainAction;
use App\ModelFilters\User\UsersCommissionConfigFilter;
use App\Models\User\UsersCommissionConfig;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * 洗码设置列表
 */
class IndexAction extends MainAction
{

    /**
     * @var object
     */
    protected $model;

    /**
     * @param UsersCommissionConfig $usersCommissionConfig 洗码Model.
     * @param Request               $request               Request.
     * @throws \Exception Exception.
     */
    public function __construct(UsersCommissionConfig $usersCommissionConfig, Request $request)
    {
        parent::__construct($request);
        $this->model = $usersCommissionConfig;
    }

    /**
     * @param array $inputDatas 接收的参数.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(array $inputDatas): JsonResponse
    {
        $inputDatas['platformSign'] = $this->currentPlatformEloq->sign;
        $data                       = $this->model
            ->filter($inputDatas, UsersCommissionConfigFilter::class)
            ->with('configDetail.userGrade')
            ->get()
            ->toArray();
        $msgOut                     = msgOut($data);
        return $msgOut;
    }
}
