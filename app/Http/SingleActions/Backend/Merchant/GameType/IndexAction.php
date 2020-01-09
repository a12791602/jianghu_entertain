<?php

namespace App\Http\SingleActions\Backend\Merchant\GameType;

use App\Http\Controllers\BackendApi\BackEndApiMainController;
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
     * @param BackEndApiMainController $contll     Contll.
     * @param array                    $inputDatas InputDatas.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(BackEndApiMainController $contll, array $inputDatas): JsonResponse
    {
        $inputDatas['platform_id'] = $contll->currentPlatformEloq->id;
        $pageSize                  = $this->model::getPageSize();
        $datas                     = $this->model::with('gameType:id,name,sign')
                                          ->filter($inputDatas, GameTypePlatformFilter::class)
                                          ->paginate($pageSize);
        $result                    = msgOut(true, $datas);
        return $result;
    }
}
