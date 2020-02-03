<?php

namespace App\Http\SingleActions\Frontend\Common\GamesLobby;

use App\Http\SingleActions\MainAction;
use App\Models\Platform\GamesPlatform;
use App\Services\FactoryService;
use Illuminate\Http\JsonResponse;

/**
 * Class InGameAction
 * @package App\Http\SingleActions\Frontend\Common\GamesLobby
 */
class InGameAction extends MainAction
{
    /**
     * @param array $inputDatas InputDatas.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(array $inputDatas): JsonResponse
    {
        $const        = FactoryService::getInstence()->generateService('constant');
        $gamePlatform = GamesPlatform::with(
            [
             'games' => static function ($query) use ($const) {
                    $query = $query->where('games.status', $const::STATUS_NORMAL);
                    return $query;
             },
            ],
        )->where('game_sign', $inputDatas['sign'])
         ->where('platform_sign', $this->user->platform_sign)
         ->where('status', $const::STATUS_NORMAL)
         ->first();
        if (!$gamePlatform) {
            throw new \Exception('100700');
        }
        $vendorSign = $gamePlatform->games->vendor->sign;
        $gameSign   = $inputDatas['sign'];
        $result     = FactoryService::getInstence()
            ->generateGame($vendorSign, $gameSign)
            ->setPreDataOfGame($gamePlatform->games, $this->user)
            ->game();
        $msgOut     = msgOut($result);
        return $msgOut;
    }
}
