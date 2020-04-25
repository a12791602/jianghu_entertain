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
     * @param array $inputDatas InputDatas.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(array $inputDatas): JsonResponse
    {
        if (isset($inputDatas['pageSize'])) {
            $this->model->setPerPage($inputDatas['pageSize']);
        }
        $inputDatas['platform_id'] = $this->currentPlatformEloq->id;
        $datas                     = $this->model->with(
            [
             'games:id,name,sign',
             'vendor:game_vendors.id,game_vendors.name,game_vendors.sign',
            ],
        )->orderByDesc('sort')
         ->filter($inputDatas, GamesPlatformFilter::class)
         ->withCacheCooldownSeconds(86400)
         ->paginate();
        return msgOut($datas);
    }
}
