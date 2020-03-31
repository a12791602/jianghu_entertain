<?php

namespace App\Http\SingleActions\Frontend\Common\GamesLobby;

use App\Http\SingleActions\MainAction;
use App\JHHYLibs\GameCommons;
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
        $result = GameCommons::getGameRequirement($this->currentPlatformEloq, $inputDatas);
        /** @var \App\Models\Game\Game $curentGameObj */
        $curentGameObj = null;
        /** @var \App\Models\Game\GameVendor $curentVendorObj */
        $curentVendorObj = null;
        extract($result, EXTR_OVERWRITE);
        $gameInstance = GameCommons::gameInit($curentVendorObj);
        $result       = $gameInstance->game($curentGameObj, $this);
        return msgOut($result);
    }
}
