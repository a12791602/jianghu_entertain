<?php

namespace App\Http\SingleActions\Frontend\Common\GamesLobby;

use App\Http\SingleActions\MainAction;
use App\JHHYLibs\GameCommons;
use App\JHHYLibs\JHHYCnst;
use App\Models\Game\Game;
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
        $result = $this->_checkcriteria($inputDatas);
        /** @var Game $curentGameObj */
        $curentGameObj = null;
        /** @var \App\Models\Game\GameVendor $curentVendorObj */
        $curentVendorObj = null;
        extract($result, EXTR_OVERWRITE);
        $gameInstance = GameCommons::gameInit($curentVendorObj);
        $result       = $gameInstance->game($curentGameObj, $this);
        $msgOut       = msgOut($result);
        return $msgOut;
    }

    /**
     * @param array $inputDatas InputDatas.
     * @return mixed[]
     * @throws \Exception Exception.
     */
    private function _checkcriteria(array $inputDatas): array
    {
        $result = $this->_checkCriterial4Games($inputDatas);
        /** @var Game $curentGameObj */
        $curentGameObj = null;
        /** @var \App\Models\Game\GameVendor $curentVendorObj */
        $curentVendorObj = null;
        extract($result);
        $this->_checkCriteria4InternalTB($curentGameObj, $inputDatas);
        $data = [
                 'curentGameObj'   => $curentGameObj,
                 'curentVendorObj' => $curentVendorObj,
                ];
        return $data;
    }

    /**
     * ##############################[检查游戏与厂商]##############################
     * @param array $inputDatas InputDatas.
     * @return mixed[]
     * @throws \Exception Exception.
     */
    private function _checkCriterial4Games(array $inputDatas): array
    {
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
              JHHYCnst::STATUS_NORMAL,
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
        $data            = [
                            'curentGameObj'   => $curentGameObj,
                            'curentVendorObj' => $curentVendorObj,
                           ];
        return $data;
    }


    /**
     * ##############################[检查平台已分配的游戏]##############################
     * @param Game  $curentGameObj GameObj.
     * @param array $inputDatas    InputDatas.
     * @return void
     * @throws \Exception Exception.
     */
    private function _checkCriteria4InternalTB(Game $curentGameObj, array $inputDatas): void
    {
        $pfDistributedGamesEloq = $this->currentPlatformEloq->games();
        if (!$pfDistributedGamesEloq->exists()) {
            throw new \Exception('100705');//'对不起,平台还未被分配游戏!'
        }
        $pfDistributedGames = $pfDistributedGamesEloq->wherePivot('game_id', $inputDatas['game_series_id'])
            ->wherePivot('status', 1)
            ->first();
        if ($pfDistributedGames === null) {
            throw new \Exception('100706');//'对不起,平台游戏未开启!'
        }
        //############################【检查平台已分配的游戏 是否与 总控已有开启中的游戏 匹配】#######
        if ($curentGameObj->id !== $pfDistributedGames->id) {
            throw new \Exception('100707');//'对不起,平台已分配游戏与原游戏不匹配!'
        }
    }
}
