<?php

namespace App\Http\SingleActions\Backend\Merchant\Bank;

use App\Http\Controllers\BackendApi\BackEndApiMainController;
use App\ModelFilters\Finance\SystemPlatformBankFilter;
use Illuminate\Http\JsonResponse;

/**
 * Class IndexAction
 * @package App\Http\SingleActions\Backend\Merchant\Notice\Carousel
 */
class IndexAction extends BaseAction
{

    /**
     * @var object $model
     */
    public $model;

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
        $data                        = $this->model::with('bank:id,name')
            ->filter($inputDatas, SystemPlatformBankFilter::class)->paginate($pageSize);
        $msgOut                      = msgOut(true, $data);
        return $msgOut;
    }
}
