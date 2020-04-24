<?php

namespace App\Http\SingleActions\Backend\Headquarters\Merchant\Platform;

use App\Http\SingleActions\MainAction;
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
        $inputDatas['unassign_platform_id'] = $inputDatas['platform_id'];

        $game = new Game();
        if (isset($inputDatas['pageSize'])) {
            $game->setPerPage($inputDatas['pageSize']);
        }

        $outputDatas = $game->filter($inputDatas)->select(
            [
             'id',
             'name',
             'sign',
             'vendor_id',
            ],
        )->paginate();
        return msgOut($outputDatas);
    }
}
