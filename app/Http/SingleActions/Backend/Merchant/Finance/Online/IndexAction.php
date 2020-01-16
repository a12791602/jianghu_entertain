<?php

namespace App\Http\SingleActions\Backend\Merchant\Finance\Online;

use App\Http\Controllers\BackendApi\BackEndApiMainController;
use App\ModelFilters\Finance\SystemFinanceOnlineInfoFilter;
use Illuminate\Http\JsonResponse;

/**
 * Class IndexAction
 * @package App\Http\SingleActions\Backend\Merchant\Finance\Online
 */
class IndexAction extends BaseAction
{

    /**
     * @var mixed
     */
    protected $model;

    /**
     * @param BackEndApiMainController $contll     Contll.
     * @param array                    $inputDatas InputDatas.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(BackEndApiMainController $contll, array $inputDatas): JsonResponse
    {
        $inputDatas['platform_sign'] = $contll->currentPlatformEloq->sign;
        $pageSize                    = $this->model::getPageSize();
        $data                        = $this->model::with(
            [
             'channel:id,name,sign',
             'author:id,name',
             'lastEditor:id,name',
            ],
        )->filter($inputDatas, SystemFinanceOnlineInfoFilter::class)->paginate($pageSize);
        $msgOut                      = msgOut($data);
        return $msgOut;
    }
}
