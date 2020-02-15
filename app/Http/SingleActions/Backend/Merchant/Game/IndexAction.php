<?php

namespace App\Http\SingleActions\Backend\Merchant\Game;

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
     * @param array   $inputDatas InputDatas.
     * @param integer $device     Device.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(array $inputDatas, int $device): JsonResponse
    {
        $inputDatas['platform_sign'] = $this->currentPlatformEloq->sign;
        $inputDatas['device']        = $device;
        $datas                       = $this->model::with(
            [
             'games:id,name,sign',
             'vendor:games_vendors.id,games_vendors.name,games_vendors.sign',
            ],
        )->orderByDesc('sort')
         ->filter($inputDatas, GamesPlatformFilter::class)
         ->withCacheCooldownSeconds(86400)
         ->get();
        $result                      = msgOut($datas);
        return $result;
    }
}
