<?php

namespace App\Http\SingleActions\Backend\Headquarters\Merchant\Platform;

use App\Http\SingleActions\MainAction;
use App\ModelFilters\Game\GameFilter;
use App\Models\Game\Game;
use Illuminate\Http\JsonResponse;

/**
 * Class UnassignGamesAction
 * @package App\Http\SingleActions\Backend\Headquarters\Merchant\Platform
 */
class UnassignGamesAction extends MainAction
{
    /**
     * @param array $inputDatas InputDatas.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(array $inputDatas): JsonResponse
    {
        $pageSize                           = Game::getPageSize();
        $inputDatas['unassign_platform_id'] = $inputDatas['platform_id'];
        $outputDatas                        = Game::filter($inputDatas, GameFilter::class)->select(
            [
             'id',
             'name',
             'sign',
             'vendor_id',
            ],
        )->paginate($pageSize);
        $msgOut                             = msgOut($outputDatas);
        return $msgOut;
    }
}
