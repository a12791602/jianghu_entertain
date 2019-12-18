<?php

namespace App\Http\SingleActions\Backend\Merchant\Game;

use App\Http\Controllers\BackendApi\Merchant\MerchantApiMainController;
use App\ModelFilters\Platform\GamesPlatformFilter;
use App\Models\Game\GameVendorPlatform;
use Illuminate\Http\JsonResponse;

/**
 * Class IndexAction
 * @package App\Http\SingleActions\Backend\Merchant\Game
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
        $inputDatas['platform_sign'] = $contll->currentPlatformEloq->sign;
        $inputDatas['device']        = GameVendorPlatform::DEVICE_APP;
        $datas                       = $this->model::with(['games:id,name,sign', 'vendor'])
            ->filter($inputDatas, GamesPlatformFilter::class)
            ->withCacheCooldownSeconds(86400)
            ->get();
        $result                      = msgOut(true, $datas);
        return $result;
    }
}
