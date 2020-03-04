<?php

namespace App\Http\SingleActions\Backend\Headquarters\Merchant\Platform;

use App\Http\SingleActions\MainAction;
use App\Models\Platform\GamePlatform;
use Illuminate\Http\JsonResponse;

/**
 * Class AssignGamesAction
 * @package App\Http\SingleActions\Backend\Headquarters\Merchant\Platform
 */
class AssignGamesAction extends MainAction
{
    /**
     * @param array $inputDatas InputDatas.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(array $inputDatas): JsonResponse
    {
        $data = [];
        foreach ($inputDatas['game_ids'] as $game_id) {
            $tmpData                = [];
            $tmpData['platform_id'] = $inputDatas['platform_id'];
            $tmpData['game_id']     = $game_id;
            $data[]                 = $tmpData;
        }
        try {
            GamePlatform::insert($data);
            $msgOut = msgOut();
            return $msgOut;
        } catch (\Throwable $exception) {
            throw new \Exception('302000');
        }
    }
}
