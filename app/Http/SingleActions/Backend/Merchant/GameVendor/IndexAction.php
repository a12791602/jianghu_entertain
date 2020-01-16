<?php

namespace App\Http\SingleActions\Backend\Merchant\GameVendor;

use App\Http\Controllers\BackendApi\BackEndApiMainController;
use App\ModelFilters\Game\GameVendorPlatformFilter;
use Illuminate\Http\JsonResponse;

/**
 * Class IndexAction
 * @package App\Http\SingleActions\Backend\Merchant\GameVendor
 */
class IndexAction extends BaseAction
{

    /**
     * @var object
     */
    protected $model;

    /**
     * @param BackEndApiMainController $contll     Contll.
     * @param array $inputDatas InputDatas.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(BackEndApiMainController $contll, array $inputDatas): JsonResponse
    {
        $inputDatas['platform_id'] = $contll->currentPlatformEloq->id;
        $datas                     = $this->model::with('gameVendor')
                                          ->orderByDesc('sort')
                                          ->filter($inputDatas, GameVendorPlatformFilter::class)
                                          ->withCacheCooldownSeconds(86400)
                                          ->get();
        return msgOut($datas);
    }
}
