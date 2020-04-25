<?php

namespace App\Http\SingleActions\Backend\Headquarters\Merchant\Platform;

use App\Http\SingleActions\MainAction;
use App\Models\Game\GamePlatform;
use Illuminate\Http\JsonResponse;

/**
 * Class AssignedGameCancelAction
 *
 * @package App\Http\SingleActions\Backend\Headquarters\Merchant\Platform
 */
class AssignedGameCancelAction extends MainAction
{
    /**
     * @param  array $inputDatas InputDatas.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(array $inputDatas): JsonResponse
    {
        $result = GamePlatform::where('platform_id', $inputDatas['platform_id'])
            ->whereIn('game_id', $inputDatas['game_ids'])->delete();
        if ($result) {
            return msgOut();
        }
        throw new \Exception('302001');
    }
}
