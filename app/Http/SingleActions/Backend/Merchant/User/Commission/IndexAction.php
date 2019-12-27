<?php

namespace App\Http\SingleActions\Backend\Merchant\User\Commission;

use App\Http\Controllers\BackendApi\BackEndApiMainController;
use App\ModelFilters\User\UsersCommissionConfigFilter;
use App\Models\User\UsersCommissionConfig;
use Illuminate\Http\JsonResponse;

/**
 * 洗码设置列表
 */
class IndexAction
{

    /**
     * @var object
     */
    protected $model;

    /**
     * @param UsersCommissionConfig $usersCommissionConfig 洗码Model.
     */
    public function __construct(UsersCommissionConfig $usersCommissionConfig)
    {
        $this->model = $usersCommissionConfig;
    }

    /**
     * @param BackEndApiMainController $contll     Controller.
     * @param array                    $inputDatas 接收的参数.
     * @return JsonResponse
     */
    public function execute(BackEndApiMainController $contll, array $inputDatas): JsonResponse
    {
        $inputDatas['platformSign'] = $contll->currentPlatformEloq->sign;
        $data                       = $this->model
            ->filter($inputDatas, UsersCommissionConfigFilter::class)
            ->get()
            ->toArray();
        $msgOut                     = msgOut(true, $data);
        return $msgOut;
    }
}
