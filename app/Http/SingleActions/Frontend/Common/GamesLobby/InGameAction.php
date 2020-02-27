<?php

namespace App\Http\SingleActions\Frontend\Common\GamesLobby;

use App\Http\SingleActions\MainAction;
use App\Services\FactoryService;
use Illuminate\Http\JsonResponse;

/**
 * Class InGameAction
 * @package App\Http\SingleActions\Frontend\Common\GamesLobby
 */
class InGameAction extends MainAction
{
    /**
     * $this->currentPlatformEloq->gameTypes()
     * select * from `game_types`
     * inner join `game_type_platforms` on
     * `game_types`.`id` = `game_type_platforms`.`type_id`
     * where `game_type_platforms`.`platform_id` = ?"
     *
     * $currentGameTypeEloq->games()
     * "select * from `games`
     * inner join `game_vendors` on
     * `game_vendors`.`id` = `games`.`vendor_id`
     * where `game_vendors`.`type_id` = ?"
     *
     * @param array $inputDatas InputDatas.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(array $inputDatas): JsonResponse
    {
        $factoryInstance  = FactoryService::getInstence();
        $const            = $factoryInstance->generateService('constant');
        $allGameTypesEloq = $this->currentPlatformEloq->gameTypes();
        if (!$allGameTypesEloq->exists()) {
            throw new \Exception('100700');//'对不起,平台游戏类型未被分配!'
        }
        $currentGameTypeEloq = $allGameTypesEloq->where('game_types.id', $inputDatas['game_types_id'])->first();
        if ($currentGameTypeEloq === null) {
            throw new \Exception('100701');//'对不起,对应游戏类型不存在!'
        }
        $allGameUnderSpecificVendor = $currentGameTypeEloq->games();
        if (!$allGameUnderSpecificVendor->exists()) {
            throw new \Exception('100702');//'对不起,对应游戏不存在!'
        }
        $currentGamesEloq = $allGameUnderSpecificVendor->where(
            [
             [
              'games.id',
              $inputDatas['game_series_id'],
             ],
             [
              'games.status',
              $const::STATUS_NORMAL,
             ],
            ],
        );
        if (!$currentGamesEloq->exists()) {
            throw new \Exception('100703');//'对不起,游戏已关闭!'
        }
        $curentGameObj         = $currentGamesEloq->first();
        $currentGameVendorEloq = $curentGameObj->vendor();
        if (!$currentGameVendorEloq->exists()) {
            throw new \Exception('100704');//'对不起,游戏厂商不存在!'
        }
        $curentVendorObj = $currentGameVendorEloq->first();
        $gameClass       = $factoryInstance->generateGame($curentVendorObj, $this->user);
        $result          = $gameClass->game($curentGameObj);
        $msgOut          = msgOut($result);
        return $msgOut;
    }
}
