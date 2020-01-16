<?php

namespace App\Http\SingleActions\Backend\Headquarters\Merchant\Platform;

use App\Models\Platform\GamesPlatform;
use Illuminate\Http\JsonResponse;

/**
 * Class AssignGamesAction
 * @package App\Http\SingleActions\Backend\Headquarters\Merchant\Platform
 */
class AssignGamesAction
{
    /**
     * @param array $inputDatas InputDatas.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(array $inputDatas): JsonResponse
    {
        $data = [];
        foreach ($inputDatas['game_signs'] as $game_sign) {
            $tmpData                  = [];
            $tmpData['platform_sign'] = $inputDatas['platform_sign'];
            $tmpData['game_sign']     = $game_sign;
            $data[]                   = $tmpData;
        }
        try {
            GamesPlatform::insert($data);
            $msgOut = msgOut();
            return $msgOut;
        } catch (\Throwable $exception) {
            throw new \Exception('302000');
        }
    }
}
