<?php

namespace App\Http\SingleActions\Backend\Merchant\Bank;

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
     * @param array $inputDatas InputDatas.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(array $inputDatas): JsonResponse
    {
        $inputDatas['platform_sign'] = $this->currentPlatformEloq->sign;
        $pageSize                    = $this->model::getPageSize();
        $data                        = $this->model::with('bank:id,name')
            ->filter($inputDatas, SystemPlatformBankFilter::class)->paginate($pageSize);
        return msgOut($data);
    }
}
