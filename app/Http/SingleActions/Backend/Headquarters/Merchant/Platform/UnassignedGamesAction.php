<?php

namespace App\Http\SingleActions\Backend\Headquarters\Merchant\Platform;

use App\Http\SingleActions\MainAction;
use App\Models\Game\Game;
use App\Models\Game\GamePlatform;
use Illuminate\Http\JsonResponse;

/**
 * Class UnassignedGamesAction
 * @package App\Http\SingleActions\Backend\Headquarters\Merchant\Platform
 */
class UnassignedGamesAction extends MainAction
{
    /**
     * @param array $inputData InputData.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(array $inputData): JsonResponse
    {
        $game = new Game();
        if (isset($inputData['pageSize'])) {
            $game->setPerPage($inputData['pageSize']);
        }
        $condition                = [];
        $condition['status']      = GamePlatform::STATUS_OPEN;
        $condition['platform_id'] = $inputData['platform_id'];
        $assigned_game            = GamePlatform::where($condition)->get(['game_id'])->unique('game_id');
        $assigned_game_ids        = $assigned_game->pluck('game_id');

        $outputDatas = $game->whereNotIn('id', $assigned_game_ids)->filter($inputData)->select(
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
