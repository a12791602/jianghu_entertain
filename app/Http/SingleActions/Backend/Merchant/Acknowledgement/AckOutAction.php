<?php

namespace App\Http\SingleActions\Backend\Merchant\Acknowledgement;

use App\JHHYLibs\GameCommons;
use App\Models\Game\GameVendor;

/**
 * Class AckInAction
 * @package App\Http\SingleActions\Backend\Merchant\Acknowledgement
 */
class AckOutAction
{
    /**
     * @param array $inputDatas 参数.
     * @return void
     * @throws \RuntimeException RuntimeException.
     */
    public function execute(array $inputDatas = []): void
    {
        $curentVendorObj = GameVendor::where('sign', 'VR')->first();
        if ($curentVendorObj === null) {
            throw new \RuntimeException('203200');
        }
        $gameInstance = GameCommons::gameInit($curentVendorObj);
        $gameInstance->upScore($inputDatas);
        $gameInstance->msgOut();
    }
}
