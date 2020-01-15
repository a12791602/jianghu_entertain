<?php

namespace App\Http\SingleActions\Backend\Headquarters\Merchant\Platform;

use App\Models\Platform\GamesPlatform;
use Illuminate\Http\JsonResponse;

/**
 * Class AssignedGameCancelAction
 *
 * @package App\Http\SingleActions\Backend\Headquarters\Merchant\Platform
 */
class AssignedGameCancelAction
{
    /**
     * @param  array $inputDatas InputDatas.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(array $inputDatas): JsonResponse
    {
        $result = GamesPlatform::where('platform_sign', $inputDatas['platform_sign'])
            ->whereIn('game_sign', $inputDatas['game_signs'])->delete();
        if ($result) {
            $msgOut = msgOut(true);
            return $msgOut;
        }
        throw new \Exception('302001');
    }
}
