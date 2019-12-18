<?php

namespace App\Http\SingleActions\Backend\Merchant\GameType;

use App\Http\Controllers\BackendApi\Merchant\MerchantApiMainController;
use App\ModelFilters\Game\GameTypePlatformFilter;
use Illuminate\Http\JsonResponse;

/**
 * Class IndexAction
 * @package App\Http\SingleActions\Backend\Merchant\GameType
 */
class IndexAction extends BaseAction
{

    /**
     * @var object
     */
    protected $model;

    /**
     * @param MerchantApiMainController $contll     Contll.
     * @param array                     $inputDatas InputDatas.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(MerchantApiMainController $contll, array $inputDatas): JsonResponse
    {
        $inputDatas['platform_id'] = $contll->currentPlatformEloq->id;
        $pageSize                  = $this->model::getPageSize();
        $datas                     = $this->model::with('gameType')
            ->filter($inputDatas, GameTypePlatformFilter::class)
            ->paginate($pageSize);
        $result                    = msgOut(true, $datas);
        return $result;
    }
}
