<?php

namespace App\Http\SingleActions\Frontend\Common\GamesLobby;

use App\Http\SingleActions\MainAction;
use App\JHHYLibs\GameCommons;
use App\Models\Game\GameVendor;
use App\Models\User\FrontendUser;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Arr;

/**
 * Class InGameAction
 * @package App\Http\SingleActions\Frontend\Common\GamesLobby
 */
class InGameTxBalanceOutAction extends MainAction
{
    /**
     * @param array $inputDatas InputDatas.
     * @return JsonResponse
     * @throws \RuntimeException Exception.
     */
    public function execute(array $inputDatas): JsonResponse
    {
        $criteriaInput   = Arr::only($inputDatas, 'vendor');
        $curentVendorObj = GameVendor::filter($criteriaInput)->first();
        if (! $curentVendorObj instanceof GameVendor) {
            throw new \RuntimeException('100704');//对不起,游戏厂商不存在!
        }
        $gameInstance = GameCommons::gameInit($curentVendorObj);
        if (! $this->user instanceof FrontendUser) {
            throw new \RuntimeException('100505');//用户不存在
        }
        $inputDatas['guid'] = $this->user->guid;
        $gameInstance->upScore($inputDatas);
        return msgOut();
    }
}
