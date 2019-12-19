<?php

namespace App\Http\SingleActions\Backend\Merchant\Game;

use App\Http\Controllers\BackendApi\Merchant\MerchantApiMainController;
use App\ModelFilters\Platform\GamesPlatformFilter;
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
     * @param integer                   $device     Device.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(MerchantApiMainController $contll, array $inputDatas, int $device): JsonResponse
    {
        $inputDatas['platform_sign'] = $contll->currentPlatformEloq->sign;
        $inputDatas['device']        = $device;
        $datas                       = $this->model::with(['games:id,name,sign', 'vendor'])
            ->orderByDesc('sort')
            ->filter($inputDatas, GamesPlatformFilter::class)
            ->withCacheCooldownSeconds(86400)
            ->get();
        $result                      = msgOut(true, $datas);
        return $result;
    }
}
