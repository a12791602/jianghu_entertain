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
        $inputDatas['platform_id'] = $this->currentPlatformEloq->id;
        $inputDatas['device']      = $device;
        $datas                     = $this->model::with(
            [
             'games:id,name,sign',
             'vendor:game_vendors.id,game_vendors.name,game_vendors.sign',
            ],
        )->orderByDesc('sort')
         ->filter($inputDatas, GamesPlatformFilter::class)
         ->withCacheCooldownSeconds(86400)
         ->paginate($this->model::getPageSize());
        $result                    = msgOut($datas);
        return $result;
    }
}
