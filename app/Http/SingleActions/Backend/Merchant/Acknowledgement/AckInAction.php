<?php

namespace App\Http\SingleActions\Backend\Merchant\Acknowledgement;

use App\Http\SingleActions\MainAction;
use App\JHHYLibs\GameCommons;
use App\Models\Game\GameVendor;

/**
 * Class AckInAction
 * @package App\Http\SingleActions\Backend\Merchant\Acknowledgement
 */
class AckInAction extends MainAction
{

    /**
     * @param array $inputDatas 参数.
     * @return void
     * @throws \Exception|\RuntimeException Exception.
     */
    public function execute(array $inputDatas = []): void
    {
        $curentVendorObj = GameVendor::where('sign', 'VR')->first();
        if ($curentVendorObj === null) {
            throw new \RuntimeException('203200');
        }
        $gameInstance = GameCommons::gameInit($curentVendorObj);
        $gameInstance->downScore($inputDatas);
        $gameInstance->msgOut();
    }
}
